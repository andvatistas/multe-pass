import argparse
import csv
import json
from pprint import pprint
import requests
import sys
import pandas as pd



#Parser Initialization
parser = argparse.ArgumentParser(description = 'CLI Interoperability API')

#Format Parser
formatparse = argparse.ArgumentParser(add_help=False)
formatparse.add_argument('--format', help = 'Select output format', default = "json", type = str, choices = ['json','csv'])
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
sp_passesperstation.add_argument('--station')
sp_passesperstation.add_argument('--datefrom')
sp_passesperstation.add_argument('--dateto')

#Passes Analysis
sp_passesanalysis = sp.add_parser('passesanalysis', parents = [formatparse], help = 'Passes Analysis between 2 Operators')
sp_passesanalysis.add_argument('--op1')
sp_passesanalysis.add_argument('--op2')
sp_passesanalysis.add_argument('--datefrom')
sp_passesanalysis.add_argument('--dateto')

#Passes Cost
sp_passescost = sp.add_parser('passescost', parents = [formatparse], help = 'Cost of passes between 2 Operators')
sp_passescost.add_argument('--op1')
sp_passescost.add_argument('--op2')
sp_passescost.add_argument('--datefrom')
sp_passescost.add_argument('--dateto')

#Charges By
sp_chargesby = sp.add_parser('chargesby', parents = [formatparse], help = 'Passes from vehicles belonging to other Operators')
sp_chargesby.add_argument('--op')
sp_chargesby.add_argument('--datefrom')
sp_chargesby.add_argument('--dateto')

#Create the Namespace
ns = parser.parse_args()

#Output (format) functions
def print_json(request):
    json_data = request.json()
    pprint(json_data)

def print_csv(request):
    json_data = request.json()
    df = pd.json_normalize(json_data)
    df.to_csv(sys.stdout)

#Switch - Case ( peripoy :) )
if sys.argv[1] == 'healthcheck':
    print('healtcheck')
    request_string = "http://localhost:9103/interoperability/api/admin/healthcheck"
    request = requests.get(request_string)
elif sys.argv[1] == 'resetvehicles':
    request_string = "http://localhost:9103/interoperability/api/admin/resetvehicles"
    request = requests.post(request_string)
elif sys.argv[1] == 'resetpasses':
    request_string = "http://localhost:9103/interoperability/api/admin/resetpasses"
    request = requests.post(request_string)
elif sys.argv[1] == 'resetstations':
    request_string = "http://localhost:9103/interoperability/api/admin/resetstations"
    request = requests.post(request_string)
elif sys.argv[1] == 'passesperstation':
    request_string = "http://localhost:9103/interoperability/api/passesperstation/" + str(ns.station) + "/" + str(ns.datefrom) + "/" + str(ns.dateto)
    request = requests.get(request_string)
elif sys.argv[1] == 'passesanalysis':
    request_string = "http://localhost:9103/interoperability/api/PassesAnalysis/" + str(ns.op1) + "/" + str(ns.op2) + "/" + str(ns.datefrom) +"/" + str(ns.dateto)
    request = requests.get(request_string)
elif sys.argv[1] == 'passescost':
    request_string = "http://localhost:9103/interoperability/api/PassesCost/" + str(ns.op1) + "/" + str(ns.op2) + "/" + str(ns.datefrom) +"/" + str(ns.dateto)
    request = requests.get(request_string)
elif sys.argv[1] == 'chargesby':
    request_string = "http://localhost:9103/interoperability/api/ChargesBy/" + str(ns.op) + "/" + str(ns.datefrom) + "/" + str(ns.dateto)
    request = requests.get(request_string)

#Format Checks
if ns.format == 'json':
    print_json(request)

if ns.format == 'csv':
    print_csv(request)
