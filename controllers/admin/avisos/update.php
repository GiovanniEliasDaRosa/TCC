<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$id_aviso = $_POST['id_aviso'];
$titulo = $_POST['titulo'];

$aviso = $db->query('SELECT * FROM Tb_aviso WHERE id_aviso=:id_aviso', [
  ':id_aviso' => $id_aviso
])->findOrFail();

$errors = [];

if (!Validator::string($titulo, 1, 40)) {
  $errors['body'] =  'Um título com mais de 40 caracteres não é necessário';
}

if (!empty($errors)) {
  return view('admin/avisos/edit.view.php', [
    'errors' => $errors,
    'aviso' => $aviso
  ]);
}

$db->query('UPDATE `tb_aviso` SET id_aviso = :id_aviso, dt_inicio = :dt_inicio, dt_fim = :dt_fim, titulo = :titulo, corpo = :corpo WHERE id_aviso = :id_aviso', [
  ':id_aviso' => $id_aviso,
  ':titulo' => $titulo,
  ':corpo' => $_POST['corpo'],
  ':dt_inicio' => $_POST['dt_inicio'],
  ':dt_fim' => $_POST['dt_fim']
]);

header('location: /admin/avisos');
exit();
