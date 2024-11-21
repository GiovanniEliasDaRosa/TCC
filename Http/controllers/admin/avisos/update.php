<?php

use Core\App;
use Core\Database;
use Http\Forms\WarnForm;
use Core\Session;

date_default_timezone_set('America/Sao_Paulo');


$form = WarnForm::validate($attributes = [
  'titulo' => $_POST['titulo'],
  'corpo' => $_POST['corpo'],
  'dt_inicio' => $_POST['dt_inicio'],
  'dt_fim' => $_POST['dt_fim'],
  'updating' => true
]);

$id_aviso = $_POST['id_aviso'];

$db = App::resolve(Database::class);

$aviso = $db->query('SELECT * FROM Tb_aviso WHERE id_aviso=:id_aviso', [
  ':id_aviso' => $id_aviso
])->findOrFail();

$db->query('UPDATE `Tb_aviso` SET id_aviso = :id_aviso, dt_fim = :dt_fim, titulo = :titulo, corpo = :corpo WHERE id_aviso = :id_aviso', [
  ':id_aviso' => $id_aviso,
  ':titulo' => $attributes['titulo'],
  ':corpo' => $attributes['corpo'],
  ':dt_fim' => $attributes['dt_fim']
]);

Session::put('saved', true);

header('location: /admin/avisos');
exit();
