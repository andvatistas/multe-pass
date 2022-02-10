# Multe-Pass

![Python](https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![NodeJS](https://img.shields.io/badge/node.js-6DA55F?style=for-the-badge&logo=node.js&logoColor=white)
![Express.js](https://img.shields.io/badge/express.js-%23404d59.svg?style=for-the-badge&logo=express&logoColor=%2361DAFB)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Apache](https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white)


Github repository of Multe-Pass software.

## Μέλη της ομάδας TL21-60:
- Andreas Vatistas | el18020
- Vasilis Vrettos | el18126
- Avgoustinos - Nektarios Dritsas | el18142
- Nicholas Rallakis | el18150

# Εγκατάσταση

# Docker
Ολόκληρη η εφαρμογή έχει γίνει "Dockerized" και μπορεί να γίνει installed πολύ εύκολα εάν έχετε διαθέσιμη την εφαρμογή `Docker`.

## Εγκατάσταση με Docker:

1. Ανοίγετε terminal στο home directory του repository
2. Εκτελείτε την παρακάτω εντολή (βεβαιωθείτε ότι έχετε το Docker Compose πρώτα, αλλιώς κατεβάστε το από το επίσημο site ή με την χρήση του αγαπημένου σας packet manager):
```bash
docker-compose up
```
3. Παρακολουθήστε την εγκατάσταση των images και την δημιουργία των containers. Με το που τελειώσει η εγκατάσταση κάντε χρήση της παρακάτω εντολής για να δείτε εάν ενεργοποιήθηκαν ορθά τα containers
```bash
docker ps
```
Πρέπει να δείτε 4 containers να τρέχουν:
  - MariaDB
  - API
  - PHP-Apache
  - CLI

Πλέον μπορείτε να χρησιμοποιήσετε την υπηρεσία κανονικά. Παρακάτω υπάρχει ο πίνακας με τα ports που ακούνε οι υπηρεσίες στο `HOST` μηχάνημα:

  | SERVICE | PORT |
  | ------- | ---- |
  | MariaDB | 3306 |
  | API | 9103 |
  | Frontend - Apache | 8000 |
  | CLI | *NO PORT NEEDED* |
