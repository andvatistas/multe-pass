import argparse
import csv
import json
from pprint import pprint
import requests
import sys
import pandas as pd


#Positional Arguments (Scope)
parser = argparse.ArgumentParser(description = 'CLI Interoperability API')
parser.add_argument('healthcheck', help = 'Check Database Connection Status')
parser.add_argument('resetpasses', help = 'Reset Passes Table from DB')
parser.add_argument('resetstations', help = 'Reset Stations Table from DB')
parser.add_argument('resetvehicles', help = 'Reset Vehicles Table from DB')

#Option Arguments / Parameter Arguments
parser.add_argument('--format', help = 'select format, either JSON (default) or CSV')

args = parser.parse_args()


r = requests.get("http://localhost:9103/interoperability/api/admin/healthcheck")
r2 = requests.get("http://localhost:9103/interoperability/api/PassesPerStation/AO01/20201201/20210101")
# pprint(r.json())


def print_json(request):
    json_data = request.json()
    pprint(json_data)

def print_csv(request):
    json_data = request.json()
    df = pd.json_normalize(json_data)
    df.to_csv(sys.stdout)
# def print_csv(request):
#     json_data = request.json()
#     pprint(json_data)
#     csv_data = csv.writer(sys.stdout)
#     csv_data.writerow(json_data[0].keys())
#     print("hi")
#     for row in json_data:
#         csv_data.writerow(row.values())
#print_json(r2)
#print_csv(r2)
