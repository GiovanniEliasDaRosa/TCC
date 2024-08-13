<?php
$svr='127.0.0.1';
$usuario='root';
$senha='';
$banco='HorarioEscolarDB';
$con=@mysqli_connect($svr,$usuario,$senha,$banco)
or die('Contate o administrador - não foi possivel conectar a base de dados!');
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,'SET character_set_connection=utf8');
mysqli_query($con,'SET character_set_client=utf8');
mysqli_query($con,'SET character_set_results=utf8');
?>