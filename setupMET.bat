@echo on

REM Step 1
cd auth-test

REM Step 2
npm install

REM Step 3
npm run build

REM Step 4
echo. > .env

REM Step 5
copy .env.example .env

REM Step 6
php artisan key:generate

REM Step 7 (Please provide the actual URL for the setup page)
start http://127.0.0.1/metiraq/setup

REM Step 8
start cmd /k "php artisan serve"

REM Step 9
copy routes\dtyroute.txt routes\web.php
