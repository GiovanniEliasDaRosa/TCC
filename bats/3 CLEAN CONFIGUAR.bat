@echo off

cls
@echo  ^> Criando do zero...
echo.

Timeout /t 1

cls
cd C:/xampp/htdocs/TCC/bats/configure
call php configureclean.php
cd /

pause
