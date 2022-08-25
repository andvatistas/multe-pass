import pytest
import sys
import os
from argparse import Namespace
from subprocess import PIPE, Popen
import subprocess

sys.path.insert(1, '../../cli/src')
from helpers import validateNamespace, validateRequestCode

def test_namespaceValidator1(capsys):
    ns = Namespace(scope='passesanalysis', format='csv', delimiter=';', op1='aodos', op2='egnatia', datefrom='20190101', dateto='20190201')
    assert validateNamespace(ns) == 'ok'

def test_namespaceValidator2(capsys):
    ns = Namespace(scope='healthcheck', format='json', delimiter=';')
    assert validateNamespace(ns) == 'ok'

def test_namespaceValidator_f1(capsys):
    ns = Namespace(scope='passesanalysis', format='json', delimiter=';', op1='aodos12', op2='egnatia', datefrom='20190101', dateto='20190201')
    assert validateNamespace(ns) == 'fail'

def test_namespaceValidator_f2(capsys):
    ns = Namespace(scope='passesanalysis', format='json', delimiter=';', op1='aodos', op2='egnatia', datefrom='201901012', dateto='20190201')
    assert validateNamespace(ns) == 'fail'
