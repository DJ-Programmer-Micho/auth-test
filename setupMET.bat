@echo on

REM Step 1: Change directory to auth-test
cd auth-test

REM Step 2: Install dependencies
npm install

REM Step 3: Build the project
npm run build

REM Step 4: Create the .env file
type nul > .env

REM Step 5: Copy from .env.example to .env
copy .env.example .env

REM Step 6: Generate the application key
php artisan key:generate

REM Step 7: Start the server
php artisan serve

REM Step 8: Copy the route file
copy routes\dtytroute.txt routes\web.php
