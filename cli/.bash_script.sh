#!/bin/bash
function se2160() {
    /usr/local/bin/python3 ~/cli/src/se2160.py $@
}

function cli_unit_test() {
  cd ~/test-cli/unit_testing
  /usr/local/bin/python3 -m pytest -vv
  cd ~
}
function cli_func_test() {
  cd ~/test-cli/func_testing
  /usr/local/bin/python3 -m pytest -vv
  cd ~
}
