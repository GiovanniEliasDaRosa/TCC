<?php

use Core\App;
use Core\Database;

function clearScreen()
{
  echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
}

const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . '/vendor/autoload.php';
require base_path('bootstrap.php');

echo "  \e[44m | - - - - - - - - - - - - - - - - | \e[0m\n";
echo "  \e[44m : Configurações de BANCO DE DADOS : \e[0m\n";
echo "  \e[44m | - - - - - - - - - - - - - - - - | \e[0m\n";
echo "\n";

$trys = 0;
$maxTries = 1;
$db = null;
do {
  echo "  > Tentando conectar com bando de dados...\n\n";

  try {
    $db = App::resolve(Database::class);
  } catch (Exception $e) {
    $trys++;
    $db = null;
    echo " \e[101m\e[30m Erro ao tentar conectar com Banco de dados ($trys) \e[0m\n";
    echo " Verifique se o XAMPP possui o \e[44m Apache \e[0m e \e[44m MySQL \e[0m ligados\n";
    echo "\n";
    echo "\n";
    sleep(1);
  }
} while ($db == null && $trys < $maxTries);

if ($trys == $maxTries) {
  clearScreen();
  echo "\n";
  echo "  \e[101m\e[30m | - - - - - - - - - - - - - - - - - - - - - - - - | \e[0m\n";
  echo "  \e[101m\e[30m :  Não foi possível conectar com o Banco de dados : \e[0m\n";
  echo "  \e[101m\e[30m | - - - - - - - - - - - - - - - - - - - - - - - - | \e[0m\n";
  echo "\n";
  echo "  Número de tentativas: $trys \n";
  echo "\n";
  echo "  Acabando com a execução do arquivo \n";
  echo "\n";
  echo "  Tente rodar \"2 DESCONFIGURAR.bat\" mais uma vez com \e[44m XAMPP ligado \e[0m com o \e[44m Apache \e[0m e \e[44m MySQL \e[0m \n";
  echo "\n";
  exit();
}

echo "   Removendo tabelas do banco de dados...\n";

$db->query("DROP TABLE IF EXISTS `tb_horario`")->get();
$db->query("DROP TABLE IF EXISTS `tb_aviso`")->get();
$db->query("DROP TABLE IF EXISTS `users`")->get();

sleep(1);
clearScreen();
echo "  [===============o] (2/2) 100%\n";
echo "  - Banco de dados desconfigurado com sucesso!\n";
echo "  - Sistema de roteador desconfigurado com sucesso!\n";
echo "\n";
echo "         :::::::::::::::\n";
echo "         : \e[32mTudo certo!\e[0m :\n";
echo "         :::::::::::::::\n";
echo "\n\e[39m";
