import os
import pytest
import sys
import subprocess
from subprocess import PIPE, Popen

#General passescost test
def test_passescost_gen(capsys):
    process = Popen("python ../cli/src/se2160.py passescost --op1 aodos --op2 egnatia --datefrom 20190101 --dateto 20190201", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    assert "'PassesCost': 22.4" in str(stdout)
    assert stderr == b''
#KO->OO 13,8 (taken directly from spreadsheet)
def test_passescost_ko(capsys):
    process = Popen("python ../cli/src/se2160.py passescost --op1 olympia_odos --op2 kentriki_odos --datefrom 20201001 --dateto 20201101", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    assert "'PassesCost': 13.8" in str(stdout)
    assert stderr == b''
#OO->KO 8,85 (taken directly from spreadsheet)
def test_passescost_oo(capsys):
    process = Popen("python ../cli/src/se2160.py passescost --op1 kentriki_odos --op2 olympia_odos --datefrom 20201001 --dateto 20201101", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    assert "'PassesCost': 8.85" in str(stdout)
    assert stderr == b''
#Same operator test
def test_passescost_f_sameop(capsys):
    process = Popen("python ../cli/src/se2160.py passescost --op1 aodos --op2 aodos --datefrom 20201001 --dateto 20201101", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == 'Operators must not be the same'
#Wrong operator test
def test_passescost_f_wrongop(capsys):
    process = Popen("python ../cli/src/se2160.py passescost --op1 aodos1 --op2 egnatia --datefrom 20201001 --dateto 20201101", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == 'aodos1 not a valid operator - check your input'
#Wrong Date test
def test_passescost_f_date(capsys):
    process = Popen("python ../cli/src/se2160.py passescost --op1 aodos --op2 egnatia --datefrom 202010011 --dateto 20201101", shell=True, stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_err = str(stderr.decode("utf-8")).rstrip("\r\n")
    assert stdout == b''
    assert decoded_err == "Date format must be 'YYYYMMDD'"
