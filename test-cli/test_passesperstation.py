import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess

#Wrong Station Test
def test_passesperstation_f_station(capsys):
    process = Popen("python ../cli/src/se2160.py passesperstation --station AO0 --datefrom 20190101 --dateto 20190201", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == "Station ID is not valid - Example of valid Station ID: 'AO01'"
#Wrong Date test
def test_passesperstation_f_date(capsys):
    process = Popen("python ../cli/src/se2160.py passesperstation --station AO01 --datefrom 20190101 --dateto 201902012", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == "Date format must be 'YYYYMMDD'"
