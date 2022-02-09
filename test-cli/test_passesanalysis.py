import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess


#The [:-2] slicing is to remove the /r/n new line from windows terminal export
def test_passesanalysis_gen(capsys):
    f = open('test_data/passesanalysis', encoding='utf-16')
    output = f.read()
    process = Popen("python ../cli/src/se2160.py passesanalysis --op1 aodos --op2 egnatia --datefrom 20190101 --dateto 20190201", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_out = str(stdout.decode("utf-8"))[:-2]
    assert output[:-1] in decoded_out
    assert stderr == b''
def test_passesanalysis_f_sameop(capsys):
    process = Popen("python ../cli/src/se2160.py passesanalysis --op1 egnatia --op2 egnatia --datefrom 20201001 --dateto 20201101", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8"))[:-2]
    assert stdout == b''
    assert decoded_err == 'Operators must not be the same'
def test_passesanalysis_f_wrongop(capsys):
    process = Popen("python ../cli/src/se2160.py passesanalysis --op1 aodos --op2 egnat --datefrom 20201001 --dateto 20201101", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8"))[:-2]
    assert stdout == b''
    assert decoded_err == 'egnat not a valid operator - check your input'
def test_passesanalysis_f_date(capsys):
    process = Popen("python ../cli/src/se2160.py passesanalysis --op1 aodos1 --op2 egnatia --datefrom 202010011 --dateto 2020110131", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8"))[:-2]
    assert stdout == b''
    assert decoded_err == "Date format must be 'YYYYMMDD'"
