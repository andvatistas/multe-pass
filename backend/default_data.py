import pandas as pd
import csv
import json
import sys
import mariadb

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

def empty_table(table:str):
    db_conn = connect_to_db()
    cur = db_conn.cursor()
    cur.execute(f"DELETE FROM {table}")
    db_conn.close()

def fill_db_table(table:str ,fs:str) -> int:
    csv_data = pd.read_csv(fs, ';')
    header = csv_data.columns
    db_conn = connect_to_db()
    cur = db_conn.cursor()
    length = len(csv_data.id)
    j = 0
    error_counter = 0
    for i in range(length):
        try:
            if (table == 'operator'):
                query = "INSERT INTO operator (id,name,abbreviation) VALUES (?,?,?)"
                cur.execute(query, (csv_data.id[i], csv_data.name[i], csv_data.abbreviation[i]))
            elif (table == 'pass'):
                query = "INSERT INTO pass (id,timestamp,charge,stationRef,vehicleRef) VALUES (?, ?, ?, ?, ?)"
                cur.execute(query, (csv_data.id[i], str(csv_data.timestamp[i]), csv_data.charge[i], csv_data.stationRef[i], csv_data.vehicleRef[i]))
            elif (table == 'station'):
                query = "INSERT INTO station (id,stationProvider,stationName) VALUES (?,?,?)"
                cur.execute(query, (csv_data.id[i], csv_data.stationProvider[i], csv_data.stationName[i]))
            elif (table == 'vehicles'):
                query = "INSERT INTO vehicle (id,licenseYear) VALUES (?,?)"
                cur.execute(query, (csv_data.id[i], int(csv_data.licenseYear[i])))
            elif (table == 'tag'):
                query = "INSERT INTO tag (id,vehicleID,providerID) VALUES (?,?,?)"
                cur.execute(query, (csv_data.id[i], csv_data.vehicleID[i], csv_data.providerID[i]))
            db_conn.commit()
        except mariadb.Error as err:
            print(f"error: {err}")
            j = 1
            error_counter += 1
            if error_counter > 5:
                print("Too many errors - cancelling insertion")
                db_conn.close()
                exit(2)
    if j != 1:
        print(f"Succesfully added {length} passes to {table}")

    db_conn.close()
    return j


def main():
    empty_table('pass')
    empty_table('tag')
    empty_table('vehicle')
    empty_table('station')
    empty_table('operator')

    fill_db_table('operator','../database/csv_data/operator.csv')
    fill_db_table('station','../database/csv_data/station.csv')
    fill_db_table('vehicle','../database/csv_data/vehicle.csv')
    fill_db_table('tag','../database/csv_data/tag.csv')
    fill_db_table('pass','../database/csv_data/pass.csv')


if __name__ == "__main__":
    main()
