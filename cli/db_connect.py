import mariadb
import sys
import pandas as pd

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
