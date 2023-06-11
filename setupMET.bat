@echo on

REM Step 0
cd auth-test

REM Step 1
call composer install

REM Step 2
call npm install

REM Step 3
call npm run build

REM Step 4
echo. > .env

REM Step 5
copy .env.example .env

REM Step 6
start "" cmd /k "php artisan key:generate"

REM Step 7 (Please provide the actual URL for the setup page)
start http://127.0.0.1/metiraq/setup

REM Step 8
start "" cmd /k "php artisan serve"

REM Pause at the end (optional)
pause
