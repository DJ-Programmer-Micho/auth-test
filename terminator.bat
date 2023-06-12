@echo off

REM Step 1
copy routes\dtyroute.txt routes\web.php

REM Step 2: Delete the txt file
del routes\dtyroute.txt

REM Step 3: Delete the batch file
del setupMET.bat

REM Step 4: Delete the batch file
del terminator.bat
