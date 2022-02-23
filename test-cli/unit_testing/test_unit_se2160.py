import pytest
import sys
import os
from argparse import Namespace
from subprocess import PIPE, Popen
import subprocess

sys.path.insert(1, '../../cli/src')
from se2160 import getRequestString

# getRequestCode can't fail, the namespace is being validated before it is called.

def test_getRequestCode1(capsys):
    host_name = os.environ.get('API_HOST_NAME', 'localhost')
    base_url = f"http://{host_name}:9103/interoperability/api/"

    ns = Namespace(scope='passesanalysis', format='csv', delimiter=';', op1='aodos', op2='egnatia', datefrom='20190101', dateto='20190201')
    assert getRequestString(ns) == f"http://{host_name}:9103/interoperability/api/PassesAnalysis/aodos/egnatia/20190101/20190201?format=csv"

def test_getRequestCode1(capsys):
    host_name = os.environ.get('API_HOST_NAME', 'localhost')
    base_url = f"http://{host_name}:9103/interoperability/api/"

    ns = Namespace(scope='passesanalysis', format='json', delimiter=';', op1='aodos', op2='egnatia', datefrom='20190101', dateto='20190201')
    assert getRequestString(ns) == f"http://{host_name}:9103/interoperability/api/PassesAnalysis/aodos/egnatia/20190101/20190201"

def test_getRequestCode2(capsys):
    host_name = os.environ.get('API_HOST_NAME', 'localhost')
    base_url = f"http://{host_name}:9103/interoperability/api/"

    ns = Namespace(scope='healthcheck', format='json', delimiter=';')
    assert getRequestString(ns) == f"http://{host_name}:9103/interoperability/api/admin/healthcheck"
