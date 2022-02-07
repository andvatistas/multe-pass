import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess

#Healthcheck test
def test_healthcheck(capsys):
    f = open('test_data/healthcheck', encoding='utf-16')
    output = f.read()
    process = Popen("python ../cli/se2160.py healthcheck", stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_out = str(stdout.decode("utf-8"))[:-2]
    assert decoded_out == output[:-1]
    assert stderr == b''
