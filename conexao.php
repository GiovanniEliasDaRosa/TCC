<?php
$svr = '127.0.0.1';
$usuario = 'root';
$senha = '';
$banco = 'HORARIOESCOLARDB';

try {
  $con = @mysqli_connect($svr, $usuario, $senha, $banco);
} catch (Exception $e) {
  if (mysqli_connect_error()) {
    $response = mysqli_connect_error();
  }
  echo "<h1>Contate o administrador - não foi possivel conectar a base de dados!</h1><br>";
  exit();
}

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, "SET character_set_connection=utf8");
mysqli_query($con, "SET character_set_client=utf8");
mysqli_query($con, "SET character_set_results=utf8");
