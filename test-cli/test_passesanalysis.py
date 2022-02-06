import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess

def test_passesanalysis_gen(capsys):
    f = open('passesanalysis', encoding='utf-16')
    output = f.read()
    process = Popen("python ../cli/se2160.py passesanalysis --op1 aodos --op2 egnatia --datefrom 20190101 --dateto 20190201", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_out = str(stdout.decode("utf-8"))[:-2]
    assert output[:-1] in decoded_out
    assert stderr == b''
