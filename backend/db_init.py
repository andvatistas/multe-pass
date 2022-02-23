import pandas as pd
import csv
import json
import sys
import mariadb
import os

from backend_helpers import *
def db_init():
    sql_dump = os.path.abspath("../database/multe-pass.sql")
    create_database("`multe-pass`")
    conn = connect_to_db()
    cur = conn.cursor()
    cur.execute("use `multe-pass`")
    cur.execute(f"source `{sql_dump}`")
    conn.close()

def main():
    db_init()

if __name__ == "__main__":
    main()
