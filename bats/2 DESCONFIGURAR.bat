@echo off
cls
@echo   [o- - - - - - - -] (0/2)  0%%
@echo  ^> Desconfigurando sistema de roteador...
echo.

:: Copia o arquivo php.ini
copy "C:\xampp\htdocs\TCC\bats\revert\php.ini" "C:\xampp\php"
:: Copia o arquivo .htaccess
copy "C:\xampp\htdocs\TCC\bats\revert\.htaccess" "C:\xampp"
:: Copia o arquivo httpd.conf
copy "C:\xampp\htdocs\TCC\bats\revert\httpd.conf" "C:\xampp\apache\conf"
:: Copia o arquivo httpd-vhosts.conf
copy "C:\xampp\htdocs\TCC\bats\revert\httpd-vhosts.conf" "C:\xampp\apache\conf\extra"

cls
@echo   [=======o - - - -] (1/2) 50%%
@echo  - Sistema de roteador desconfigurado com sucesso!
@echo  ^> Desconfigurando o banco de dados...
echo.

cd revert/
call php revert.php
cd /

pause