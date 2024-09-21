<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
date_default_timezone_set('America/Sao_Paulo');

$avisos = $db->query('SELECT * FROM Tb_aviso ORDER BY id_aviso DESC')->get();

$date = date('Y-m-d');
foreach ($avisos as $aviso) {
  $dt_fim = $aviso['dt_fim'];

  if ($date >= $dt_fim) {
    array_splice($avisos, 0, 1);
    $db->query('DELETE FROM Tb_aviso WHERE id_aviso=:id_aviso', [
      ':id_aviso' => $aviso['id_aviso']
    ])->get();
  }
}
$saved = Session::has('saved');

view('admin/avisos/index.view.php', [
  'avisos' => $avisos,
  'saved' => $saved
]);
