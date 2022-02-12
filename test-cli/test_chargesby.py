import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess

#General Charges By test
def test_chargesby_gen(capsys):
    f = open('test_data/chargesby', encoding='utf-16')
    output = f.read()
    process = Popen("python ../cli/src/se2160.py chargesby --op aodos --datefrom 20201001 --dateto 20201101", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_out = str(stdout.decode("utf-8")).rstrip("\r\n")
    assert output[:-1] in decoded_out
    assert stderr == b''
#Wrong Operator Test
def test_chargesby_f_operator(capsys):
    process = Popen("python ../cli/src/se2160.py chargesby --op kentri_odos --datefrom 20190101 --dateto 20190201", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == "kentri_odos not a valid operator - check your input"
#Wrong Date test
def test_chargesby_f_date(capsys):
    process = Popen("python ../cli/src/se2160.py chargesby --op aodos --datefrom 20190101 --dateto 201902012", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == "Date format must be 'YYYYMMDD'"
