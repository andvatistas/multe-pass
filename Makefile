#TL21-60 Makefile

PYTHON=python3
APT=apt-get install

help:
	@echo "Usage"
	@echo "deps 	Install dependencies"
	@echo "fill-db		Fill `multe-pass` database with data"

deps: requirements.txt
	pip install -r requirements.txt

test-cli:
	cd test-cli/
	$(PYTHON) -m pytest -vv

fill-db:
	sudo mysql -u root -p multe-pass < database/multe-pass.sql
