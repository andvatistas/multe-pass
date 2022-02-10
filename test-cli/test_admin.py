import pytest
import sys
import os
from subprocess import PIPE, Popen
import subprocess

#Healthcheck test
def test_healthcheck(capsys):
    host_name = os.environ.get('API_HOST_NAME', 'localhost')
    if host_name == 'localhost':
        f = open('test_data/healthcheck', encoding='utf-16')
    else:
        f = open('test_data/healthcheck_docker', encoding='utf-16')
    output = f.read()
    process = Popen("python ../cli/src/se2160.py healthcheck", shell=True,  stdout=PIPE, stderr=PIPE)
    stdout, stderr = process.communicate()
    decoded_out = str(stdout.decode("utf-8")).rstrip("\r\n")
    assert decoded_out == output.rstrip("\r\n")
    assert stderr == b''
