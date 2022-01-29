import argparse
import csv
import json
from pprint import pprint
import requests
import sys
import pandas as pd
from requests.exceptions import HTTPError

from helpers import *

#CLI Philosophy: 1) Create a main parser that hold the --format and --delimiter options.
# 2)Create subparser for every single other command
# 3)Change the request URL depending on the input
# 4)Print the request output depending on format

#Parser Initialization
parser = argparse.ArgumentParser(description = 'CLI Interoperability API')

#Format Parser
formatparse = argparse.ArgumentParser(add_help=False)
formatparse.add_argument('--format', help = 'Select output format', default = "json", type = str, choices = ['json','csv'])
formatparse.add_argument('--delimiter', help = 'Select delimiter for CSV file (most common is either ";" or ","). Only used with --passesupd command', default = ";")

#SubParsers
sp = parser.add_subparsers(help='Subparser Init')

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

validateNamespace(ns)

#Switch - Case ( peripoy :) )
if sys.argv[1] == 'healthcheck':
    request_string = "http://localhost:9103/interoperability/api/admin/healthcheck"
elif sys.argv[1] == 'resetvehicles':
    request_string = "http://localhost:9103/interoperability/api/admin/resetvehicles"
elif sys.argv[1] == 'resetpasses':
    request_string = "http://localhost:9103/interoperability/api/admin/resetpasses"
elif sys.argv[1] == 'resetstations':
    request_string = "http://localhost:9103/interoperability/api/admin/resetstations"
elif sys.argv[1] == 'passesperstation':
    request_string = "http://localhost:9103/interoperability/api/passesperstation/" + str(ns.station) + "/" + str(ns.datefrom) + "/" + str(ns.dateto)
elif sys.argv[1] == 'passesanalysis':
    request_string = "http://localhost:9103/interoperability/api/PassesAnalysis/" + str(ns.op1) + "/" + str(ns.op2) + "/" + str(ns.datefrom) +"/" + str(ns.dateto)
elif sys.argv[1] == 'passescost':
    request_string = "http://localhost:9103/interoperability/api/PassesCost/" + str(ns.op1) + "/" + str(ns.op2) + "/" + str(ns.datefrom) +"/" + str(ns.dateto)
elif sys.argv[1] == 'chargesby':
    request_string = "http://localhost:9103/interoperability/api/ChargesBy/" + str(ns.op) + "/" + str(ns.datefrom) + "/" + str(ns.dateto)
elif sys.argv[1] == 'statistics':
    request_string = "http://localhost:9103/interoperability/api/stats/" + str(ns.parameter) + "/" + str(ns.datefrom) + "/" + str(ns.dateto)

elif sys.argv[1] == 'admin':
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

if ((sys.argv[1] != 'resetvehicles') | (sys.argv[1] != 'resetpasses') | (sys.argv[1] != 'resetstations')):
    request = requests.get(request_string)
else:
    request = requests.post(request_string)

validateRequestCode(request.status_code);

if ((sys.argv[1] != 'admin') & (ns.format=='json')):
    print_json(request)
if ((sys.argv[1] != 'admin') & (ns.format=='csv')):
    print_csv(request)
