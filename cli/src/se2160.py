#!/usr/bin/env python3
import argparse
import csv
import json
import requests
import sys
import pandas as pd
import os

from helpers import *

#CLI Philosophy: 1) Create a main parser that hold the --format and --delimiter options.
# 2)Create subparser for every single other command
# 3)Change the request URL depending on the input
# 4)Print the request output depending on format

#Get API ip ("localhost" for local or "api" for Docker)

def main():
#Parser Initialization
    host_name = os.environ.get('API_HOST_NAME', 'localhost')
    parser = argparse.ArgumentParser(description = 'CLI Interoperability API')

    #Format Parser
    formatparse = argparse.ArgumentParser(add_help=False)
    formatparse.add_argument('--format', help = 'Select output format', default = "json", type = str, choices = ['json','csv'])
    formatparse.add_argument('--delimiter', help = 'Select delimiter for CSV file (most common is either ";" or ","). Only used with --passesupd command', default = ";")

    #SubParsers
    sp = parser.add_subparsers(help='Subparser Init', dest='scope')

    #Health Check
    sp_healthcheck = sp.add_parser('healthcheck', parents = [formatparse], help = 'Check Database Connection Status')

    #Reset Functions
    sp_resetvehicles = sp.add_parser('resetvehicles', parents = [formatparse], help = 'Reset Vehicles Table from DB')
    sp_resetpasses = sp.add_parser('resetpasses', parents = [formatparse], help = 'Reset Passes Table from DB')
    sp_resetstations = sp.add_parser('resetstations', parents = [formatparse], help = 'Reset Stations Table from DB')

    #Passes Per Station
    sp_passesperstation = sp.add_parser('passesperstation', parents = [formatparse], help = 'See all passes made through a station for a specific time period')
    sp_passesperstation.add_argument('--station', required=True, help = 'StationID e.g. "AO01"')
    sp_passesperstation.add_argument('--datefrom', required=True, help = 'Period Start - Date in the form of "YYYYMMDD"')
    sp_passesperstation.add_argument('--dateto', required=True,  help = 'Period End - Date in the form of "YYYYMMDD"')

    #Passes Analysis
    sp_passesanalysis = sp.add_parser('passesanalysis', parents = [formatparse], help = 'Passes Analysis between 2 Operators')
    sp_passesanalysis.add_argument('--op1', required=True, help = 'Operator ID e.g. "aodos"')
    sp_passesanalysis.add_argument('--op2', required=True, help = 'Operator ID e.g. "aodos"')
    sp_passesanalysis.add_argument('--datefrom', required=True, help = 'Period Start - Date in the form of "YYYYMMDD"')
    sp_passesanalysis.add_argument('--dateto', required=True,  help = 'Period End - Date in the form of "YYYYMMDD"')

    #Passes Cost
    sp_passescost = sp.add_parser('passescost', parents = [formatparse], help = 'Cost of passes between 2 Operators')
    sp_passescost.add_argument('--op1', required=True, help = 'Operator ID e.g. "aodos"')
    sp_passescost.add_argument('--op2', required=True, help = 'Operator ID e.g. "aodos"')
    sp_passescost.add_argument('--datefrom', required=True, help = 'Period Start - Date in the form of "YYYYMMDD"')
    sp_passescost.add_argument('--dateto', required=True,  help = 'Period End - Date in the form of "YYYYMMDD"')

    #Charges By
    sp_chargesby = sp.add_parser('chargesby', parents = [formatparse], help = 'Passes from vehicles belonging to other Operators')
    sp_chargesby.add_argument('--op', required=True, help = 'Operator ID e.g. "aodos"')
    sp_chargesby.add_argument('--datefrom', required=True, help = 'Period Start - Date in the form of "YYYYMMDD"')
    sp_chargesby.add_argument('--dateto', required=True,  help = 'Period End - Date in the form of "YYYYMMDD"')

    #Passes update
    sp_passesupdate = sp.add_parser('admin', parents = [formatparse], help = 'Update Passes Table in Database')
    sp_passesupdate.add_argument('--passesupd', nargs='?', required=True)
    sp_passesupdate.add_argument('--source', required=True)

    #Statistics
    sp_statistics = sp.add_parser('statistics', parents = [formatparse], help = 'Extract statistics')
    sp_statistics.add_argument('--parameter', type = str, choices = ['operator', 'station'], required=True)
    sp_statistics.add_argument('--datefrom', required=True, help = 'Period Start - Date in the form of "YYYYMMDD"')
    sp_statistics.add_argument('--dateto', required=True,  help = 'Period End - Date in the form of "YYYYMMDD"')

    #Pass final arguments to Namespace
    ns = parser.parse_args()
    if (validateNamespace(ns) == 'fail'):
        exit()
    #Request URL switch-case
    base_url = f"http://{host_name}:9103/interoperability/api/"
    if ns.scope == 'healthcheck':
        request_string = base_url + "/admin/healthcheck"
    elif ns.scope == 'resetvehicles':
        request_string = base_url + "/admin/resetvehicles"
    elif ns.scope == 'resetpasses':
        request_string = base_url + "/admin/resetpasses"
    elif ns.scope == 'resetstations':
        request_string = base_url + "/admin/resetstations"
    elif ns.scope == 'passesperstation':
        request_string = base_url + f"/passesperstation/{ns.station}/{ns.datefrom}/{ns.dateto}"
    elif ns.scope == 'passesanalysis':
        request_string = base_url + f"/PassesAnalysis/{ns.op1}/{ns.op2}/{ns.datefrom}/{ns.dateto}"
    elif ns.scope == 'passescost':
        request_string = base_url + f"/PassesCost/{ns.op1}/{ns.op2}/{ns.datefrom}/{ns.dateto}"
    elif ns.scope == 'chargesby':
        request_string = base_url + f"/ChargesBy/{ns.op}/{ns.datefrom}/{ns.dateto}"
    elif ns.scope == 'statistics':
        request_string = base_url + f"/stats/{ns.parameter}/{ns.datefrom}/{ns.dateto}"

    elif ns.scope == 'admin':
        delimiter_format = ns.delimiter
        file_source = ns.source

        #Read CSV file with Pandas
        csv_data = pd.read_csv(file_source, delimiter_format)

        #Isolate Headers for easier control
        header = csv_data.columns
        #Connect to Database
        db_conn = connect_to_db()

        #Set a cursor
        cur = db_conn.cursor()

        #get length of csv file
        length = len(csv_data.id)

        j = 0 #set flag for if commit was successful
        #Run a for loop for length of csv file and INSER INTO pass one by one
        for i in range(length):
            try:
                cur.execute("INSERT INTO pass (id,timestamp,charge,stationRef,vehicleRef) VALUES (?, ?, ?, ?, ?)", (csv_data.id[i], str(csv_data.timestamp[i]), csv_data.charge[i], csv_data.stationRef[i], csv_data.vehicleRef[i]))
                db_conn.commit()
            except mariadb.Error as err:
                print(f"Error: {err}")
                j = 1 #commit was unsuccessful

        #check if commit was successful
        if j != 1:
            print(f"Successfully added {length} passes to DB")

        #Close DB connection
        db_conn.close()

    #add ?format=csv on request if --format=csv was used
    if (ns.format=='csv'):
        request_string += "?format=csv"

    if (ns.scope != 'resetvehicles') and (ns.scope != 'resetpasses') and (ns.scope != 'resetstations'):
        request = requests.get(request_string)
    else:
        request = requests.post(request_string)

    validateRequestCode(request.status_code)

    if (ns.scope != 'admin') & (ns.format == 'json'):
        print_json(request)
    if (ns.scope != 'admin') & (ns.format == 'csv'):
        print_csv(request)

if __name__== "__main__":
    main()
