<?php

use Core\App;
use Core\Database;

function clearScreen()
{
  echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
}

function showError($type)
{
  $GLOBALS['trys'] += 1;
  echo " \e[101m\e[30m Erro ao tentar conectar com Banco de dados (" . $GLOBALS['trys'] . ") \e[0m \e[101m\e[30m [ $type ] \e[0m\n";
  echo " Verifique se o XAMPP possui o \e[44m Apache \e[0m e \e[44m MySQL \e[0m ligados\n\n\n";
  sleep(1);
}

const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . '/vendor/autoload.php';
require base_path('bootstrap.php');
echo "  [===========o - -] (3/4) 75%\n";
echo " - Sistema de roteador pronto!\n";
echo " - Composer instalado com sucesso.\n";
echo " - Autoload gerado com sucesso.\n";
echo "\n";
echo "  \e[44m | - - - - - - - - - - - - - - - - | \e[0m\n";
echo "  \e[44m : Configurações de BANCO DE DADOS : \e[0m\n";
echo "  \e[44m | - - - - - - - - - - - - - - - - | \e[0m\n";
echo "\n";

$GLOBALS['trys'] = 0;
$maxTries = 10;
$db = null;

do {
  echo "  > Tentando conectar com bando de dados...\n\n";

  try {
    $db = App::resolve(Database::class);
  } catch (PDOException $e) {
    if ($e->getCode() == 1049) {
      // print("Database 'horarioescolardb' not found.");
      clearScreen();
      echo "\n";
      echo "  \e[101m\e[30m | - - - - - - - - - - - - - - - - - - | \e[0m\n";
      echo "  \e[101m\e[30m : Banco de dados aparenta não existir : \e[0m\n";
      echo "  \e[101m\e[30m | - - - - - - - - - - - - - - - - - - | \e[0m\n";
      echo "\n";
      echo "  Acabando com a execução do arquivo \n";
      echo "\n";
      echo "  ||::::.... . ..  \n";
      echo "  Para resolver \n";
      echo "\n";
      echo "  Verifique se o \e[44m XAMPP \e[0m com \e[44m Apache \e[0m e \e[44m MySQL \e[0m estão ligados\n";
      echo "\n";
      echo "  1. Acesse \e[44m 127.0.0.1/phpmyadmin \e[0m \n";
      echo "  2. Clique em \e[44m SQL \e[0m \n";
      echo "  3. Na area de texto cole o seguinte e clique em ( Go / Ir )\n";
      echo "\n";
      echo "  \e[104m CREATE DATABASE `HORARIOESCOLARDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; \e[0m\n";
      echo "\n\n";
      echo "  \e[44m Quando rodar ele \e[0m feche esse terminal e rode \"1 CONFIGURAR.bat\" mais uma vez\n";
      echo "\n";
      exit();
    } else if ($e->getCode() == 2002) {
      // print("No connection could be made");
      $db = null;
      showError('general');
    } else {
      $db = null;
      showError('router');
    }
    // print("Database error: " . $e->getMessage());
  } catch (Exception $e) {
    // print("General error: " . $e->getMessage());
    $db = null;
    showError('general');
  }
} while ($db == null && $GLOBALS['trys'] < $maxTries);

if ($GLOBALS['trys'] == $maxTries) {
  clearScreen();
  echo "\n";
  echo "  \e[101m\e[30m | - - - - - - - - - - - - - - - - - - - - - - - - | \e[0m\n";
  echo "  \e[101m\e[30m :  Não foi possível conectar com o Banco de dados : \e[0m\n";
  echo "  \e[101m\e[30m | - - - - - - - - - - - - - - - - - - - - - - - - | \e[0m\n";
  echo "\n";
  echo "  Número de tentativas: " . $GLOBALS['trys'] . " \n";
  echo "\n";
  echo "  Acabando com a execução do arquivo \n";
  echo "\n";
  echo "  Tente rodar \"1 CONFIGURAR.bat\" mais uma vez com \e[44m XAMPP ligado \e[0m com o \e[44m Apache \e[0m e \e[44m MySQL \e[0m \n";
  echo "\n";
  exit();
}

echo "   Limpando banco de dados...\n";

$db->query("DROP TABLE IF EXISTS `Tb_horario`")->get();
$db->query("DROP TABLE IF EXISTS `Tb_aviso`")->get();
$db->query("DROP TABLE IF EXISTS `Tb_usuario`")->get();

$db->query(
  "CREATE TABLE `Tb_horario` (
    `id_horario` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `horario` varchar(5),
    `turma` varchar(30),
    `segunda` varchar(40),
    `terca` varchar(40),
    `quarta` varchar(40),
    `quinta` varchar(40),
    `sexta` varchar(40)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

  CREATE TABLE `Tb_aviso` (
    `id_aviso` smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `dt_inicio` DATE,
    `dt_fim` DATE,
    `titulo` varchar(40) NOT NULL,
    `corpo` text
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

  CREATE TABLE `Tb_usuario` (
    `id_usuario` smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nome` varchar(255) NOT NULL,
    `senha` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
  "
)->find();

echo "   Adicionando usuário ao banco de dados...\n";

$user = 'admin';
$password = password_hash('123', PASSWORD_BCRYPT);

$db->query(
  "INSERT INTO `Tb_usuario` (`id_usuario`, `nome`, `senha`) VALUES
  (1, '{$user}', '{$password}')"
)->find();

sleep(1);
clearScreen();
echo "\n";
echo "         :::::::::::::::::::\n";
echo "         : \e[32mSistema zerado!\e[0m :\n";
echo "         :::::::::::::::::::\n";
echo "\n\e[39m";
