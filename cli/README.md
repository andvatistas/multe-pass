# CLI

Περιεχόμενα:

 Το CLI είναι υλοποιημένο σε python. Πριν ξεκινήσουμε την χρήση του, βεβαιώνουμε ότι έχουμε όλα τα dependencies/requirements. Αυτό το καταφέρνουμε τρέχοντας την παρακάτω εντολή στο home(~) του repository.

## Install Requirements:

```bash
pip install -r requirements.txt
```

## Usage:

#### In host
Ενώ βρισκόμαστε στο home(~) του repository:

```bash
python3 /cli/src/se2160.py -h
python3 /cli/src/se2160.py healthcheck
```

#### In Docker:
```bash
se2160 -h
se2160 healthcheck
se2160 passesanalysis --op1 aodos --op2 egnatia --datefrom 20190101 --dateto 20190201 --format csv
```
Και λοιπά...
