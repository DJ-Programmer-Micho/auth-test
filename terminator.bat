@echo off

REM Step 1
copy routes\dtyroute.txt routes\web.php

REM Step 2: Delete the batch file
del /F "setupMET.bat"

REM Step 2: Delete the batch file
del /F "terminator.bat"
