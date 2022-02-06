import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess

def test_chargesby_gen(capsys):
    f = open('chargesby', encoding='utf-16')
    output = f.read()
    process = Popen("python ../cli/se2160.py chargesby --op aodos --datefrom 20201001 --dateto 20201101", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_out = str(stdout.decode("utf-8"))[:-2]
    assert output[:-1] in decoded_out
    assert stderr == b''
