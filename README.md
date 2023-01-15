## Room Management. Alif task


## Installation
Database already included in  repositry via Sqlite3.

```sh
# PHP8.2
composer install

#ALL ARGUMENTS ARE REQUIRED

## Create user
php index.php alias=create-user username=Mehrob email=popkorn.passport@gmail.com phone=557320040

## Reserve room
php index.php alias=reserve-room roomId=1 userId=1 timeFrom="2020-12-09 20:01" timeTo="2020-12-09 20:00"


```

## Need to add:

- Validate required arguments
- Some new output
- Sending notification



