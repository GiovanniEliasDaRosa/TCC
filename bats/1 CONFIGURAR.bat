@echo off
color 0A
cls
@echo   [o- - - - - -] (0/3)  0%%
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

color 0A
cls
@echo   [===o - - - -] (1/3) 33%%
@echo  - Sistema de roteador pronto!
@echo  ^> Instalando composer...
echo.

cd ../

call composer install

color 0A
cls
@echo   [=======o - -] (2/3) 66%%
@echo  - Sistema de roteador pronto!
@echo  - Composer instalado com sucesso.
@echo  ^> Gerando autoload...
echo.

call composer dump-autoload

color 0A
cls
@echo   [===========o] (3/3) 100%%
@echo  - Sistema de roteador pronto!
@echo  - Composer instalado com sucesso.
@echo  - Autoload gerado com sucesso.
echo.
@echo          :::::::::::::::
@echo          : Tudo certo! :
@echo          :::::::::::::::
echo.
@echo  Verifique se o XAMPP esta ligado com Apache e MySQL
echo.
pause
