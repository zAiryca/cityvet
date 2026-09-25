@echo off
REM Change directory to the CityVet Laravel project
cd /d C:\xampp\htdocs\cityvet

REM Run the automatic status transition commands
C:\xampp\php\php.exe artisan pets:transition-impounded-to-adoptable
C:\xampp\php\php.exe artisan pets:transition-adoptable-to-unadopted

echo Transition commands complete.
pause
