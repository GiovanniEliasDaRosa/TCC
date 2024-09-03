@echo off
color 0A
cls
@echo   [o- - - - - -] (0/1)   0%%
@echo  ^> Desconfigurando sistema de roteador...
echo.

Timeout /t 1

:: Copia o arquivo php.ini
copy "C:\xampp\htdocs\TCC\bats\revert\php.ini" "C:\xampp\php"
:: Copia o arquivo .htaccess
copy "C:\xampp\htdocs\TCC\bats\revert\.htaccess" "C:\xampp"
:: Copia o arquivo httpd.conf
copy "C:\xampp\htdocs\TCC\bats\revert\httpd.conf" "C:\xampp\apache\conf"
:: Copia o arquivo httpd-vhosts.conf
copy "C:\xampp\htdocs\TCC\bats\revert\httpd-vhosts.conf" "C:\xampp\apache\conf\extra"

color 0A
cls
@echo   [===========o] (1/1) 100%%
@echo  - Sistema de roteador desconfigurado com sucesso!
echo.
@echo          :::::::::::::::
@echo          : Tudo certo! :
@echo          :::::::::::::::
echo.
pause
