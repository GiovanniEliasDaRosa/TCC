<?php

use Core\App;
use Core\Database;

date_default_timezone_set('America/Sao_Paulo');

$db = App::resolve(Database::class);

$db->query('DELETE FROM Tb_aviso WHERE id_aviso = :id_aviso', [
  ':id_aviso' => $_POST['id_aviso']
]);

header('location: /admin/avisos');
exit();
