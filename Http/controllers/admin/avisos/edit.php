<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$aviso = $db->query('SELECT * FROM Tb_aviso WHERE id_aviso=:id', [
  'id' => $_GET['id']
])->findOrFail();

view('admin/avisos/edit.view.php', [
  'errors' => [],
  'aviso' => $aviso
]);
