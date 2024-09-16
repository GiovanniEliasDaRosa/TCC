@echo off

cls
@echo   [o- - - - - - - -] (0/4)  0%%
@echo  ^> Configurando sistema de roteador...
echo.

Timeout /t 1

:: Copia o arquivo php.ini
copy "C:\xampp\htdocs\TCC\bats\configure\php.ini" "C:\xampp\php"
:: Copia o arquivo .htaccess
copy "C:\xampp\htdocs\TCC\bats\configure\.htaccess" "C:\xampp"
:: Copia o arquivo httpd.conf
copy "C:\xampp\htdocs\TCC\bats\configure\httpd.conf" "C:\xampp\apache\conf"
:: Copia o arquivo httpd-vhosts.conf
copy "C:\xampp\htdocs\TCC\bats\configure\httpd-vhosts.conf" "C:\xampp\apache\conf\extra"

cls
@echo   [===o - - - - - -] (1/4) 25%%
@echo  - Sistema de roteador pronto!
@echo  ^> Instalando composer...
echo.

cd ../

call composer install

cls
@echo   [=======o - - - -] (2/4) 50%%
@echo  - Sistema de roteador pronto!
@echo  - Composer instalado com sucesso.
@echo  ^> Gerando autoload...
echo.

call composer dump-autoload

cls
cd C:/xampp/htdocs/TCC/bats/configure
call php waitxampp.php

pause

cls
cd C:/xampp/htdocs/TCC/bats/configure
call php configure.php
cd /

pause
