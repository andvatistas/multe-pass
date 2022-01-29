import mariadb
import sys
import pandas as pd

validOperators = ['aodos','gefyra','kentriki_odos','nea_odos','olympia_odos','moreas','egnatia']


def connect_to_db():
    try:
        conn = mariadb.connect(
            user="root",
            password="",
            host="localhost",
            port=3306,
            database="multe-pass"
        )

    except mariadb.Error as err:
        print(f"Error connecting to multe-pass DB: {err}")
        sys.exit(1)
    return conn

def validateRequestCode(code):
    if (code == 400):
        print("400: Bad Request\n")
    elif (code == 401):
        print("401: Not Authorized\n")
    elif (code == 402):
        print("402: No Data\n")
    elif (code == 500):
        print("500: Internal Server Error\n")



def validateNamespace(ns):
    if (('datefrom' in ns) | ('dateto' in ns)):
        if (((len(ns.datefrom) != 8)) | (len(ns.dateto) != 8)):
            print("Date format must be 'YYYYMMDD'")
            exit()
    if (('op1' in ns) | ('op2' in ns)):
        if ((str(ns.op1) not in validOperators)):
            print(str(ns.op1) + " not a valid operator - check your input")
            exit()
        elif ((str(ns.op2) not in validOperators)):
            print(str(ns.op2) + " not a valid operator - check your input")
            exit()
    if (('op' in ns) | ('op2' in ns)):
        if ((str(ns.op) not in validOperators)):
            print(str(ns.op) + " not a valid operator - check your input")
            exit()
    if ('station' in ns):
        if (len(ns.station) != 4):
            print("Station ID is not valid - Example of valid Station ID: 'AO01'")
            exit()



#Output (format) functions
def print_json(request):
    request_data = request.json()
    print(request_data)

def print_csv(request):
    request_data = request.content.decode('utf-8')
    print(request_data)
