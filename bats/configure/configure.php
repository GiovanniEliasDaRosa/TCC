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

echo "   Adicionando tabelas: 'horário, aviso, usuário' ao banco de dados...\n";

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

$db->query(
  "INSERT INTO `Tb_horario` (`id_horario`, `horario`, `turma`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`) VALUES
  (1, '07:00', '1ºA', 'ELAINE - SALA 2 PORTUGUÊS ', 'CINTIA SALA 12 QUÍMICA ', 'ELAINE - SALA 2 PORTUGUÊS ', 'DANIEL BIOLOGIA SALA 10', 'GABRIELA SALA 04 MATEMÁTICA '),
  (2, '07:45', '1ºA', 'ELAINE - SALA 2 PORTUGUÊS ', 'CINTIA SALA 12 QUÍMICA ', 'ELAINE - SALA 2 PORTUGUÊS ', 'DANIEL BIOLOGIA SALA 10', 'GABRIELA SALA 04 MATEMÁTICA '),
  (3, '08:30', '1ºA', 'FLAVIO HISTÓRIA SALA 13', 'MARINA ARTE SALA 06', 'MÁGILA FILOSOFIA SALA 10', 'GABRIELA MATEMÁTICA SALA 6', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (4, '09:15', '1ºA', 'FLAVIO HISTÓRIA SALA 13', 'CARLA INGLÊS SALA  01', 'MÁGILA FILOSOFIA SALA 10', 'GABRIELA MATEMÁTICA SALA 6', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (5, '10:20', '1ºA', 'GIOVANA FÍSICA SALA 06', 'RAFA SALA 05 PV', 'MARINA EDUCAÇÃO FÍSICA ', 'GABRIELA ED. FINANCEIRA SALA 06', 'MARCOS TEC. E ROBÓTICA SALA 13'),
  (6, '11:05', '1ºA', 'CARLA REDAÇÃO    SALA 05', 'RAFA SALA 05 PV', 'MARINA EDUCAÇÃO FÍSICA ', 'GABRIELA ED. FINANCEIRA SALA 06', 'MARCOS TEC. E ROBÓTICA SALA 13'),
  (7, '11:50', '1ºA', 'CARLA REDAÇÃO    SALA 05', 'MARINA ARTE SALA 06', 'GABRIELA SALA 03 MATEMÁTICA ', 'CARLA INGLÊS       SALA 10', 'GIOVANA FÍSICA SALA 01'),
  (8, '07:00', '1ºB', 'FLAVIO HISTÓRIA SALA 13', 'ROSANA     ED. FINANCEIRA SALA 11', 'MÁGILA FILOSOFIA SALA 10', 'GIOVANA FÍSICA   SALA 13', 'DANIEL BIOLOGIA SALA 11'),
  (9, '07:45', '1ºB', 'FLAVIO HISTÓRIA SALA 13', 'ELAINE - SALA 2 PORTUGUÊS ', 'MÁGILA FILOSOFIA SALA 10', 'GIOVANA FÍSICA   SALA 13', 'DANIEL BIOLOGIA SALA 11'),
  (10, '08:30', '1ºB', 'CARLA REDAÇÃO    SALA 05', 'CINTIA SALA 12 QUÍMICA ', 'RAFA SALA 05 PV', 'BRUNO TEC. E ROBÓTICA SALA 11', 'MARINA EDUCAÇÃO FÍSICA '),
  (11, '09:15', '1ºB', 'CARLA REDAÇÃO    SALA 05', 'CINTIA SALA 12 QUÍMICA ', 'RAFA SALA 05 PV', 'BRUNO TEC. E ROBÓTICA SALA 11', 'MARINA EDUCAÇÃO FÍSICA '),
  (12, '10:20', '1ºB', 'ELAINE - SALA 2 PORTUGUÊS ', 'MARINA ARTE SALA 06', 'GABRIELA SALA 03 MATEMÁTICA ', 'CARLA INGLÊS    SALA 10', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (13, '11:05', '1ºB', 'ELAINE - SALA 2 PORTUGUÊS ', 'MARINA ARTE SALA 06', 'GABRIELA SALA 03 MATEMÁTICA ', 'ROSANA    ED. FINANCEIRA SALA 10', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (14, '11:50', '1ºB', 'GABRIELA  SALA 03 MATEMÁTICA ', 'ELAINE - SALA 2 PORTUGUÊS ', 'CARLA INGLÊS SALA  05', 'GABRIELA MATEMÁTICA SALA 6', 'GABRIELA SALA 04 MATEMÁTICA '),
  (15, '07:00', '1ºC', 'LEANDRO SALA 01 PORTUGUÊS ', 'MARINA ARTE SALA 06', 'GABRIELA SALA 03 MATEMÁTICA ', 'GABRIELA MATEMÁTICA SALA 6', 'BRUNO    ED. FINANCEIRA SALA 03'),
  (16, '07:45', '1ºC', 'LEANDRO SALA 01 PORTUGUÊS ', 'RAFA SALA 05 PV', 'GABRIELA SALA 03 MATEMÁTICA ', 'CARLA REDAÇÃO    SALA 03', 'BRUNO     ED. FINANCEIRA SALA 03'),
  (17, '08:30', '1ºC', 'GIOVANA FÍSICA SALA 06', 'RAFA SALA 05 PV', 'MARINA EDUCAÇÃO FÍSICA ', 'CARLA REDAÇÃO    SALA 03', 'FRANCIELE   BIOLOGIA SALA 11'),
  (18, '09:15', '1ºC', 'GIOVANA FÍSICA SALA 06', 'MARCOS TEC. E ROBÓTICA SALA 03', 'MARINA EDUCAÇÃO FÍSICA ', 'MURILO GEOGRAFIA SALA 03', 'FRANCIELE   BIOLOGIA SALA 11'),
  (19, '10:20', '1ºC', 'CARLA INGLÊS       SALA 05', 'MARCOS TEC. E ROBÓTICA SALA 03', 'MÁGILA FILOSOFIA SALA 10', 'MURILO GEOGRAFIA SALA 03', 'GABRIELA SALA 04 MATEMÁTICA '),
  (20, '11:05', '1ºC', 'FLAVIO HISTÓRIA SALA 13', 'LEANDRO SALA 01 PORTUGUÊS ', 'MÁGILA FILOSOFIA SALA 10', 'CINTIA SALA   QUÍMICA SALA 12', 'GABRIELA SALA 04 MATEMÁTICA '),
  (21, '11:50', '1ºC', 'FLAVIO HISTÓRIA SALA 13', 'LEANDRO SALA 01 PORTUGUÊS ', 'MARINA ARTE SALA 03', 'CINTIA SALA   QUÍMICA SALA 12', 'CARLA INGLÊS       SALA 06'),
  (22, '07:00', '1ºD', 'CARLA REDAÇÃO    SALA 05', 'FLAVIO HISTÓRIA SALA 13', 'MARINA EDUCAÇÃO FÍSICA ', 'MURILO GEOGRAFIA SALA 03', 'MARINA ARTE SALA 06'),
  (23, '07:45', '1ºD', 'CARLA REDAÇÃO    SALA 05', 'FLAVIO HISTÓRIA SALA 13', 'MARINA EDUCAÇÃO FÍSICA ', 'GABRIELA MATEMÁTICA SALA 6', 'MARINA ARTE SALA 06'),
  (24, '08:30', '1ºD', 'LEANDRO SALA 01 PORTUGUÊS ', 'CARLA INGLÊS SALA  01', 'GABRIELA SALA 03 MATEMÁTICA ', 'LEANDRO PORTUGUÊS SALA 01', 'GABRIELA SALA 04 MATEMÁTICA '),
  (25, '09:15', '1ºD', 'LEANDRO SALA 01 PORTUGUÊS ', 'RAFA SALA 05 PV', 'GABRIELA SALA 03 MATEMÁTICA ', 'LEANDRO PORTUGUÊS SALA 01', 'GABRIELA SALA 04 MATEMÁTICA '),
  (26, '10:20', '1ºD', 'MÁGILA FILOSOFIA SALA 10', 'CINTIA SALA 12 QUÍMICA ', 'DANIEL BIOLOGIA SALA 11', 'RAFA PV SALA 05', 'BRUNO    ED. FINANCEIRA SALA 03'),
  (27, '11:05', '1ºD', 'GIOVANA FÍSICA SALA 06', 'MARCOS TEC. E ROBÓTICA SALA 03', 'DANIEL BIOLOGIA SALA 11', 'CARLA INGLÊS SALA  03', 'BRUNO    ED. FINANCEIRA SALA 03'),
  (28, '11:50', '1ºD', 'GIOVANA FÍSICA SALA 06', 'MARCOS TEC. E ROBÓTICA SALA 03', 'MÁGILA FILOSOFIA SALA 10', 'MURILO GEOGRAFIA SALA 03', 'CINTIA SALA 12 QUÍMICA '),
  (29, '07:00', '2ºA', 'GABRIEL - SALA 11  GEOGRAFIA', 'CARLA REDAÇÃO    SALA 01', 'GRAZI - SALA 4 MATEMÁTICA', 'GRAZI - SALA 4 MATEMÁTICA', 'FLAVIO HISTÓRIA SALA 13'),
  (30, '07:45', '2ºA', 'GABRIEL - SALA 11  GEOGRAFIA', 'CARLA REDAÇÃO    SALA 01', 'GRAZI - SALA 4 MATEMÁTICA', 'LEANDRO INGLÊS SALA 01', 'GIOVANA FÍSICA SALA 01'),
  (31, '08:30', '2ºA', 'ELAINE - SALA 2 PORTUGUÊS ', 'ELAINE - SALA 2 PORTUGUÊS ', 'DANIEL BIOLOGIA SALA 11', 'CINTIA SALA   QUÍMICA SALA 12', 'GIOVANA FÍSICA SALA 01'),
  (32, '09:15', '2ºA', 'ELAINE - SALA 2 PORTUGUÊS ', 'ROSANA   ED. FINANCEIRA SALA 04', 'DANIEL BIOLOGIA SALA 11', 'ROSANA     ED. FINANCEIRA SALA 12', 'RAFA SALA 05 SOCIOLOGIA'),
  (33, '10:20', '2ºA', 'LEANDRO INGLÊS SALA 01', 'FLAVIO HISTÓRIA SALA 13', 'RAFA SALA 05 PV', 'CINTIA SALA   QUÍMICA SALA 12', 'CINTIA SALA 12 PV '),
  (34, '11:05', '2ºA', 'CINTIA SALA 12 EMPREENDEDORISMO', 'CINTIA SALA 12 BIOTECNOLOGIA', 'BRUNO TEC. E ROBÓTICA SALA 06', 'BRUNO TEC. E ROBÓTICA SALA 11', 'CINTIA SALA 12 PV '),
  (35, '11:50', '2ºA', 'CINTIA SALA 12 EMPREENDEDORISMO', 'CINTIA SALA 12 BIOTECNOLOGIA', 'BRUNO TEC. E ROBÓTICA SALA 06', 'BRUNO TEC. E ROBÓTICA SALA 11', 'MARINA EDUCAÇÃO FÍSICA '),
  (36, '07:00', '2ºB', 'GIOVANA FÍSICA SALA 12', 'LEANDRO INGLÊS SALA 05', 'FLAVIO HISTÓRIA SALA 13', 'ELAINE - SALA 2 PORTUGUÊS ', 'RAFA SALA 05 SOCIOLOGIA'),
  (37, '07:45', '2ºB', 'GRAZI - SALA 4 MATEMÁTICA', 'ROSANA     ED. FINANCEIRA SALA 04', 'FLAVIO HISTÓRIA SALA 13', 'ELAINE - SALA 2 PORTUGUÊS ', 'RAFA SALA 05 SOCIOLOGIA'),
  (38, '08:30', '2ºB', 'CINTIA SALA 12 QUÍMICA ', 'LEANDRO INGLÊS SALA 05', 'GRAZI - SALA 4 MATEMÁTICA', 'GIOVANA FÍSICA   SALA 13', 'CINTIA SALA 12 PV '),
  (39, '09:15', '2ºB', 'CINTIA SALA 12 QUÍMICA ', 'MARINA EDUCAÇÃO FÍSICA ', 'ELAINE - SALA 2 PORTUGUÊS ', 'GRAZI - SALA 4 MATEMÁTICA', 'CINTIA SALA 12 PV '),
  (40, '10:20', '2ºB', 'GABRIEL - SALA 11  GEOGRAFIA', 'CARLA REDAÇÃO    SALA 01', 'CARLA REDAÇÃO    SALA 01', 'ROSANA    ED. FINANCEIRA SALA 11', 'FRANCIELE   BIOLOGIA SALA 11'),
  (41, '11:05', '2ºB', 'MÁGILA FIL. E SOC. MODERNA SALA 10', 'HUMBERTO ORATÓRIA SALA 10', 'MURILO ARTE E MÍDIAS DIGITAIS SALA 01', 'RAFA LIDERANÇA SALA 05', 'FRANCIELE   BIOLOGIA SALA 11'),
  (42, '11:50', '2ºB', 'MÁGILA FIL. E SOC. MODERNA SALA 10', 'HUMBERTO ORATÓRIA SALA 10', 'MURILO ARTE E MÍDIAS DIGITAIS SALA 01', 'RAFA LIDERANÇA SALA 05', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (43, '07:00', '2º NOV', 'TEC - FERNANDO    SALA 06', 'ELAINE - SALA 2 PORTUGUÊS ', 'DANIEL BIOLOGIA SALA 11', 'CINTIA SALA   QUÍMICA SALA 12', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (44, '07:45', '2º NOV', 'PAULO EDUCAÇÃO FÍSICA ', 'TEC - ELAINE           SALA 06', 'DANIEL BIOLOGIA SALA 11', 'CINTIA SALA   QUÍMICA SALA 12', 'GABRIEL - SALA 10 GEOGRAFIA'),
  (45, '08:30', '2º NOV', 'GRAZI - SALA 4 MATEMÁTICA', 'TEC - ELAINE', 'TEC - FERNANDO    SALA 01', 'ELAINE - SALA 2 PORTUGUÊS ', 'FLAVIO HISTÓRIA SALA 13'),
  (46, '09:15', '2º NOV', 'GRAZI - SALA 4 MATEMÁTICA', 'TEC - ELAINE', 'TEC - FERNANDO', 'GIOVANA FÍSICA   SALA 13', 'TEC - SERGIO'),
  (47, '10:20', '2º NOV', 'TEC -     CARLOS        SALA 12', 'TEC   -  SERGIO       SALA 11', 'TEC - FERNANDO    SALA 11', 'GIOVANA FÍSICA   SALA 13', ''),
  (48, '11:05', '2º NOV', 'TEC - CARLOS', 'TEC - SERGIO          SALA 11', 'TEC - FERNANDO    SALA 11', 'ELAINE - SALA 2 PORTUGUÊS ', 'FLAVIO HISTÓRIA SALA 05'),
  (49, '11:50', '2º NOV', 'TEC - CARLOS', 'TEC - SERGIO          SALA 11', 'TEC - FERNANDO', 'GRAZI - SALA 4 MATEMÁTICA', 'RAFA SALA 05 SOCIOLOGIA'),
  (50, '07:00', '3ºA', 'CINTIA SALA 12 EMPREENDEDORISMO', 'MARCOS TEC. E ROBÓTICA SALA 03', 'MARCOS TEC. E ROBÓTICA SALA 06', 'BIOTECNOLOGIA PAULO SALA 11', 'CINTIA SALA 12   QUÍMICA APLICADA '),
  (51, '07:45', '3ºA', 'CINTIA SALA 12 EMPREENDEDORISMO', 'MARCOS TEC. E ROBÓTICA SALA 03', 'MARCOS TEC. E ROBÓTICA SALA 06', ' BIOTECNOLOGIA PAULO SALA 11', 'CINTIA SALA 12   QUÍMICA APLICADA '),
  (52, '08:30', '3ºA', 'PAULO EDUCAÇÃO FÍSICA ', 'FLAVIO HISTÓRIA SALA 13', 'ELAINE - SALA 2 PORTUGUÊS ', 'RAFA ACELERAÇÃO VESTIBULAR SALA 05', 'MARCOS     ED. FINANCEIRA SALA 03'),
  (53, '09:15', '3ºA', 'PAULO EDUCAÇÃO FÍSICA ', 'FLAVIO HISTÓRIA SALA 13', 'GRAZI - SALA 4 MATEMÁTICA', 'RAFA ACELERAÇÃO VESTIBULAR SALA 05', 'GIOVANA FÍSICA SALA 01'),
  (54, '10:20', '3ºA', 'GRAZI - SALA 4 MATEMÁTICA', 'ELAINE - SALA 2 REDAÇÃO ', 'GRAZI - SALA 4 MATEMÁTICA', 'ELAINE - SALA 2 PORTUGUÊS ', 'ELAINE - SALA 2 PORTUGUÊS '),
  (55, '11:05', '3ºA', 'GABRIEL - SALA 11  GEOGRAFIA', 'ELAINE - SALA 2 REDAÇÃO ', 'FLAVIO PV SALA 13', 'LEANDRO INGLÊS SALA 01', 'GIOVANA FÍSICA SALA 01'),
  (56, '11:50', '3ºA', 'GABRIEL - SALA 11  GEOGRAFIA', 'RAFA ACELERAÇÃO VESTIBULAR SALA 05', 'FLAVIO PV SALA 13', 'LEANDRO INGLÊS SALA 01', 'MARCOS     ED. FINANCEIRA SALA 13'),
  (57, '07:00', '3ºB', 'MÁGILA FIL. E SOC. MODERNA SALA 10', 'HUMBERTO ORATÓRIA SALA 10', 'GABRIEL - SALA 01 GEOPOLITICA', 'RAFA LIDERANÇA SALA 05', 'ELAINE - SALA 2 REDAÇÃO '),
  (58, '07:45', '3ºB', 'MÁGILA FIL. E SOC. MODERNA SALA 10', 'HUMBERTO ORATÓRIA SALA 10', 'GABRIEL - SALA 01 GEOPOLITICA', 'RAFA LIDERANÇA SALA 05', 'ELAINE - SALA 2 REDAÇÃO '),
  (59, '08:30', '3ºB', 'GABRIEL - SALA 11  GEOGRAFIA', 'ROSANA     ED. FINANCEIRA SALA 04', 'VINICIUS AC. VESTIBULAR SALA 06', 'GRAZI - SALA 4 MATEMÁTICA', 'MURILO ARTE E MÍDIAS D. SALA 06'),
  (60, '09:15', '3ºB', 'GABRIEL - SALA 11  GEOGRAFIA', 'LEANDRO INGLÊS SALA 03', 'VINICIUS AC. VESTIBULAR SALA 06', 'ELAINE - SALA 2 PORTUGUÊS ', 'MURILO ARTE E MÍDIAS D. SALA 06'),
  (61, '10:20', '3ºB', 'FLAVIO PV SALA 13', 'ROSANA     ED. FINANCEIRA SALA 04', 'FLAVIO PV SALA 13', 'LEANDRO INGLÊS SALA 01', 'MARINA EDUCAÇÃO FÍSICA '),
  (62, '11:05', '3ºB', 'GRAZI - SALA 4 MATEMÁTICA', 'FLAVIO HISTÓRIA SALA 13', 'GRAZI - SALA 4 MATEMÁTICA', 'GIOVANA FÍSICA SALA 13', 'MARINA EDUCAÇÃO FÍSICA '),
  (63, '11:50', '3ºB', 'ELAINE - SALA 2 PORTUGUÊS ', 'FLAVIO HISTÓRIA SALA 13', 'ELAINE - SALA 2 PORTUGUÊS ', 'GIOVANA FÍSICA SALA 13', 'VINICIUS AC. VESTIBULAR SALA 03'),
  (64, '07:00', '3ºNOV A', 'TEC - CARLOS', 'MURILO ARTE SALA 04', 'TEC - FERNANDO', 'TEC - CARLOS', 'MURILO ARTE SALA 01'),
  (65, '07:45', '3ºNOV A', 'TEC - CARLOS', 'TEC - CARLOS', 'TEC - FERNANDO', 'TEC - CARLOS', 'TEC - FLAVIO'),
  (66, '08:30', '3ºNOV A', 'TEC - CARLOS', 'TEC - CARLOS', 'FLAVIO ELETIVAS  SALA 13', 'PAULO EDUCAÇÃO FÍSICA ', 'ELAINE - SALA 2 PORTUGUÊS '),
  (67, '09:15', '3ºNOV A', 'TEC - CARLOS', 'TEC - RUBENS', 'FLAVIO ELETIVAS  SALA 13', 'PAULO EDUCAÇÃO FÍSICA ', 'ELAINE - SALA 2 PORTUGUÊS '),
  (68, '10:20', '3ºNOV A', 'TEC - FERNANDO', 'TEC - RUBENS', 'TEC - CARLOS', 'GRAZI - SALA 4 MATEMÁTICA', 'CARLA INGLÊS       SALA 06'),
  (69, '11:05', '3ºNOV A', 'TEC - FERNANDO', 'TEC - RUBENS', 'TEC - CARLOS', 'GRAZI - SALA 4 MATEMÁTICA', 'TEC - CARLOS'),
  (70, '11:50', '3ºNOV A', 'TEC - FERNANDO', 'CARLA INGLÊS SALA  04', 'GRAZI - SALA 4 MATEMÁTICA', 'ELAINE - SALA 2 PORTUGUÊS ', 'TEC - CARLOS'),
  (71, '07:00', '3ºNOV N', 'GRAZI - SALA 4 MATEMÁTICA', 'TEC - RUBENS', 'TEC - CARLOS', 'CARLA INGLÊS       SALA 1', 'TEC - SERGIO'),
  (72, '07:45', '3ºNOV N', 'TEC - FERNANDO', 'TEC - RUBENS', 'TEC - CARLOS', 'MURILO ARTE SALA 4', 'TEC - SERGIO'),
  (73, '08:30', '3ºNOV N', 'TEC - FERNANDO', 'TEC - RUBENS', 'TEC - CARLOS', 'TEC - CARLOS', 'TEC - SERGIO'),
  (74, '09:15', '3ºNOV N', 'TEC - FERNANDO', 'TEC - CARLOS', 'TEC - CARLOS', 'TEC - CARLOS', 'TEC - FLAVIO'),
  (75, '10:20', '3ºNOV N', 'PAULO EDUCAÇÃO FÍSICA ', 'TEC - ELAINE', 'MURILO ARTE SALA 06', 'TEC - CARLOS', 'TEC - CARLOS'),
  (76, '11:05', '3ºNOV N', 'PAULO EDUCAÇÃO FÍSICA ', 'TEC - ELAINE', 'CARLA INGLÊS       SALA 05', 'TEC - CARLOS', 'ELAINE - SALA 2 PORTUGUÊS '),
  (77, '11:50', '3ºNOV N', 'GRAZI - SALA 4 MATEMÁTICA', 'TEC - CARLOS', 'TEC - CARLOS', 'TEC - CARLOS', 'ELAINE - SALA 2 PORTUGUÊS '),
  (78, '19:00', '1ºE', 'LEANDRO PORTUGUÊS ', 'LEANDRO PORTUGUÊS ', 'RAQUEL ARTE ', 'GIOVANA MATEMÁTICA', 'FLÁVIO HISTÓRIA '),
  (79, '19:45', '1ºE', 'ROSANA ED. FINANCEIRA', 'LEANDRO PORTUGUÊS ', 'GIOVANA MATEMÁTICA', 'GIOVANA MATEMÁTICA', 'FLÁVIO HISTÓRIA '),
  (80, '20:50', '1ºE', 'ROSANA ED. FINANCEIRA', 'GABRIEL   GEOGRAFIA', 'RAQUEL PV', 'LARISSA FILOSOFIA ', 'CARLA REDAÇÃO'),
  (81, '21:35', '1ºE', 'LEANDRO PORTUGUÊS ', 'CÍNTIA QUÍMICA ', 'GIOVANA MATEMÁTICA', 'LEANDRO INGLÊS ', 'DANIEL BIOLOGIA '),
  (82, '22:15', '1ºE', 'EDERSON FÍSICA', 'CÍNTIA QUÍMICA ', 'GIOVANA MATEMÁTICA', 'LEANDRO INGLÊS ', 'DANIEL BIOLOGIA '),
  (83, '19:00', '2ºC', 'EDERSON FÍSICA', 'EDERSON TECNOLIGIA E ROBÓTICA', 'BRUNO EMPREENDEDORISMO', 'GRAZI MATEMÁTICA', 'EDERSON TECNOLIGIA E ROBÓTICA'),
  (84, '19:45', '2ºC', 'EDERSON FÍSICA', 'CÍNTIA BIOTECNOLOGIA', 'BRUNO EMPREENDEDORISMO', 'GRAZI MATEMÁTICA', 'EDERSON TECNOLIGIA E ROBÓTICA'),
  (85, '20:50', '2ºC', 'LEANDRO PORTUGUÊS ', 'CÍNTIA QUÍMICA ', 'LEANDRO PORTUGUÊS ', 'RAFA SOCIOLOGIA', 'DANIEL BIOLOGIA '),
  (86, '21:35', '2ºC', 'ROSANA ED. FINANCEIRA', 'GABRIEL   GEOGRAFIA', 'RAQUEL PV', 'CARLA REDAÇÃO', 'FLÁVIO HISTÓRIA '),
  (87, '22:15', '2ºC', 'ROSANA ED. FINANCEIRA', 'LEANDRO INGLÊS ', 'LEANDRO PORTUGUÊS ', 'CARLA REDAÇÃO', 'GRAZI MATEMÁTICA'),
  (88, '19:00', '3ºC', 'RAQUEL  ORATÓRIA', 'GABRIEL   GEOPOLÍTICA', 'LEANDRO PORTUGUÊS ', 'RAFA LIDERANAÇA ', 'CARLA REDAÇÃO'),
  (89, '19:45', '3ºC', 'RAQUEL  ORATÓRIA', 'GABRIEL   GEOPOLÍTICA', 'RAQUEL  ARTE E MÍDIAS DIGITAIS', 'RAFA LIDERANAÇA ', 'CARLA REDAÇÃO'),
  (90, '20:50', '3ºC', 'EDERSON FÍSICA', 'LEANDRO INGLÊS ', 'LARISSA FILOSOFIA E SOC. MODERNA ', 'GRAZI MATEMÁTICA', 'GRAZI MATEMÁTICA'),
  (91, '21:35', '3ºC', 'EDERSON FÍSICA', 'LEANDRO INGLÊS ', 'LEANDRO PORTUGUÊS ', 'GRAZI MATEMÁTICA', 'GRAZI MATEMÁTICA'),
  (92, '22:15', '3ºC', 'LEANDRO PORTUGUÊS ', 'GABRIEL   GEOGRAFIA', 'RAQUEL PV', 'GRAZI MATEMÁTICA', 'FLÁVIO HISTÓRIA '),
  (93, '19:00', 'EJA', 'BRUNO ED. FINANCEIRA ', 'FLAVIO HISTÓRIA ', 'LARISSA FILOSOFIA ', 'SILVANA BIOLOGIA ', 'MURILO ARTE'),
  (94, '19:45', 'EJA', 'BRUNO ED. FINANCEIRA ', 'FLAVIO HISTÓRIA ', 'LARISSA SOCIOLOGIA', 'SILVANA BIOLOGIA ', 'BIOTECNOLOGIA DANIEL'),
  (95, '20:50', 'EJA', 'CARLA  PORTUGUÊS', 'BRUNO EMPREENDEDORISMO', 'BRUNO MATEMÁTICA', 'CARLA INGLÊS', 'EDERSON FÍSICA '),
  (96, '21:35', 'EJA', 'CARLA  PORTUGUÊS', 'BRUNO MATEMÁTICA', 'BRUNO MATEMÁTICA', 'LARISSA GEOGRAFIA ', 'EDERSON QUIMICA '),
  (97, '22:15', 'EJA', 'CARLA  PORTUGUÊS', 'BRUNO MATEMÁTICA', 'BRUNO EMPREENDEDORISMO', 'LARISSA GEOGRAFIA ', 'CARLA  PORTUGUÊS');"
)->find();

echo "   Adicionando avisos  ao banco de dados...\n";

date_default_timezone_set('America/Sao_Paulo');

$today = date('Y-m-d');
$date = date_create(date('Y-m-d'));
$date2 = date_create(date('Y-m-d'));
date_add($date, date_interval_create_from_date_string("7 days"));
date_add($date2, date_interval_create_from_date_string("8 days"));
$expireDate = date_format($date, 'Y-m-d');
$expireDate2 = date_format($date2, 'Y-m-d');

$db->query(
  "INSERT INTO `Tb_aviso` (`id_aviso`, `dt_inicio`, `dt_fim`, `titulo`, `corpo`) VALUES
  (1, '$today', '$expireDate', 'Não haverá aula', ''),
  (2, '$today', '$expireDate2', 'Excursão ao Museu de Arte de São Paulo', 'Prezados estudantes e responsáveis,\r\n\r\nTemos o prazer de anunciar a emocionante excursão ao Museu de Arte de São Paulo (MASP)! Esta é uma oportunidade única para explorar a rica história da arte e apreciar obras-primas de artistas renomados. Aqui estão os detalhes importantes:\r\n\r\n- Data: 15 de outubro de 2024 (terça)\r\n- Horário de saída: 8h00\r\n- Local de partida: Escola\r\n- Preço por aluno: R$ 30,00 (inclui transporte e ingresso)\r\n- Professores orientadores: Prof.ª Maria Silva e Prof. João Santos\r\n- Horário de retorno: Previsto para as 17h00 (chegada à escola)\r\n\r\nAtenciosamente,\r\nEquipe Escolar');"
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
echo "  [===============o] (4/4) 100%\n";
echo " - Sistema de roteador pronto!\n";
echo " - Composer instalado com sucesso.\n";
echo " - Autoload gerado com sucesso.\n";
echo " - Banco de dados configurado com sucesso.\n";
echo "\n";
echo "         :::::::::::::::\n";
echo "         : \e[32mTudo certo!\e[0m :\n";
echo "         :::::::::::::::\n";
echo "\n\e[39m";
