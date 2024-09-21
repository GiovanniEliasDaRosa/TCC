<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\WarnForm;

date_default_timezone_set('America/Sao_Paulo');

$form = WarnForm::validate($attributes = [
  'titulo' => $_POST['titulo'],
  'corpo' => $_POST['corpo'],
  'dt_inicio' => $_POST['dt_inicio'],
  'dt_fim' => $_POST['dt_fim']
]);

$db = App::resolve(Database::class);
$db->query(
  'INSERT INTO Tb_aviso(titulo, corpo, dt_inicio, dt_fim) VALUES(:titulo, :corpo, :dt_inicio, :dt_fim)',
  [
    ':titulo' => $attributes['titulo'],
    ':corpo' => $attributes['corpo'],
    ':dt_inicio' => $attributes['dt_inicio'],
    ':dt_fim' => $attributes['dt_fim'],
  ]
);

Session::put('saved', true);

header('location: /admin/avisos/new');
die();
