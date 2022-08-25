# CLI-Testing

Η υλοποίηση του testing έγινε με χρήση της βιβλιοθήκης "pytest". Ελέγχει τις διάφορες λειτουργίες που εκτελεί το CLI. Πριν τρέξουμε τα test, βεβαιώνουμε ότι έχουμε εγκαταστήσει τις βιβλιοθήκες python τα οποία είναι dependecies/requirements για το CLI και για το testing του. (Οδηγίες αναφέρονται στον φάκελο CLI)

## Run Tests:

#### In Host
Ενώ βρισκόμαστε στον φάκελο test-cli:

```bash
python -m pytest -vv
```
Η επιλογή `-vv` είναι επιλογή `verbose` και μπορεί να ρυθμιστεί αναλόγως με τις προτιμήσεις μας. Εμείς προτιμήσαμε `-vv` αντί για `-v`

#### In Docker
```bash
cli_unit_test
cli_func_test
```
