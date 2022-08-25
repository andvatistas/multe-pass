#TL21-60 Makefile
PWD:= $(shell pwd)
PYTHON=python3
APT=apt-get install

help:
	@echo "Usage"
	@echo "deps 	Install dependencies"
	@echo "create-db		Create `multe-pass` database and fill with default data"

deps: requirements.txt
	pip install -r requirements.txt

test-cli:
	cd test-cli/
	$(PYTHON) -m pytest -vv

create-db:
	$(PYTHON) $PWD/db_init.py
