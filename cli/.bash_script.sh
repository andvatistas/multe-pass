#!/bin/bash

function se2160() {
    /usr/local/bin/python3 ~/cli/src/se2160.py $@
}

function cli_test() {
  cd ~/test-cli
  /usr/local/bin/python3 -m pytest -vv
  cd ~
}
