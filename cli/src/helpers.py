import mariadb
import sys
import pandas as pd
import os

validOperators = ['aodos','gefyra','kentriki_odos','nea_odos','olympia_odos','moreas','egnatia']

def connect_to_db():
    host_name = os.environ.get('DB_HOST_NAME', 'localhost')
    try:
        conn = mariadb.connect(
            user="root",
            password="",
            host=host_name,
            port=3306,
            database="multe-pass"
        )

    except mariadb.Error as err:
        print(f"Error connecting to multe-pass DB: {err}")
        sys.exit(1)
    return conn

def validateRequestCode(code):
    if (code == 400):
        print("400: Bad Request\n", file=sys.stderr)
    elif (code == 401):
        print("401: Not Authorized\n", file=sys.stderr)
    elif (code == 402):
        print("402: No Data\n", file=sys.stderr)
    elif (code == 500):
        print("500: Internal Server Error\n", file=sys.stderr)

def validateNamespace(ns):
    if (('datefrom' in ns) | ('dateto' in ns)):
        if (((len(ns.datefrom) != 8)) | (len(ns.dateto) != 8)):
            print("Date format must be 'YYYYMMDD'", file=sys.stderr)
            return 'fail'
    if (('op1' in ns) | ('op2' in ns)):
        if ((str(ns.op1) not in validOperators)):
            print(str(ns.op1) + " not a valid operator - check your input", file=sys.stderr)
            return 'fail'
        elif ((str(ns.op2) not in validOperators)):
            print(str(ns.op2) + " not a valid operator - check your input", file=sys.stderr)
            return 'fail'
        if ((str(ns.op1) == str(ns.op2))):
            print("Operators must not be the same", file=sys.stderr)
            return 'fail'
    if ('op' in ns):
        if ((str(ns.op) not in validOperators)):
            print(str(ns.op) + " not a valid operator - check your input", file=sys.stderr)
            return 'fail'
    if ('station' in ns):
        if (len(ns.station) != 4):
            print("Station ID is not valid - Example of valid Station ID: 'AO01'", file=sys.stderr)
            return 'fail'



#Output (format) functions
def print_json(request):
    request_data = request.json()
    print(request_data)

def print_csv(request):
    request_data = request.content.decode('utf-8')
    print(request_data)
