@echo off

REM Step 1
copy routes\dtyroute.txt routes\web.php

REM Step 2: Delete the batch file
del /F "path/to/setupMET.bat"

REM Step 2: Delete the batch file
del /F "path/to/terminator.bat"
