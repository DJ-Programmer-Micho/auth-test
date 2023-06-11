@echo on

REM Step 1: Clone the repository
git clone https://github.com/DJ-Programmer-Micho/auth-test.git

REM Step 2: Change directory to auth-test
cd auth-test

REM Step 3: Install dependencies
npm install

REM Step 4: Build the project
npm run build

REM Step 5: Create the .env file
type nul > .env

REM Step 6: Copy from .env.example to .env
copy .env.example .env

REM Step 7: Generate the application key
php artisan key:generate

REM Step 8: Start the server
php artisan serve

REM Step 9: Copy the route file
copy routes\dtytroute.txt routes\web.php
