<?php

use Core\App;
use Core\Database;
use Core\Session;

date_default_timezone_set('America/Sao_Paulo');

$db = App::resolve(Database::class);

$aviso = $db->query('SELECT * FROM Tb_aviso WHERE id_aviso=:id', [
  'id' => $_GET['id']
])->findOrFail();

view('admin/avisos/edit.view.php', [
  'aviso' => $aviso,
  'errors' => Session::get('errors'),
  'title' => 'Editar Avisos Admin'
]);
