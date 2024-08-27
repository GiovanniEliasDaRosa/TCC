<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$titulo = $_POST['titulo'];
$corpo = $_POST['corpo'];
$dt_inicio = $_POST['dt_inicio'];
$dt_fim = $_POST['dt_fim'];

$errors = [];

if (!Validator::string($titulo, 1, 40)) {
  $errors['body'] =  'Um título com mais de 40 caracteres não é necessário';
}

if (!empty($errors)) {
  return view('admin/avisos/create.view.php', [
    'errors' => $errors
  ]);
}

$db->query(
  'INSERT INTO Tb_aviso(titulo, corpo, dt_inicio, dt_fim) VALUES(:titulo, :corpo, :dt_inicio, :dt_fim)',
  [
    ':titulo' => $titulo,
    ':corpo' => $corpo,
    ':dt_inicio' => $dt_inicio,
    ':dt_fim' => $dt_fim,
  ]
);

header('location: /admin/avisos/new');
die();
