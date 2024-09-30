<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
date_default_timezone_set('America/Sao_Paulo');

$avisos = $db->query('SELECT * FROM Tb_aviso ORDER BY id_aviso DESC')->get();

if (empty($avisos)) {
  view('user/avisos.view.php', [
    'avisos' => 'Nenhum aviso disponível no momento',
    'title' => 'Avisos',
    'noWarnings' => true,
  ]);
  die();
}

$date = date('Y-m-d');
foreach ($avisos as $aviso) {
  $dt_inicio = $aviso['dt_inicio'];
  $dt_fim = $aviso['dt_fim'];

  if ($dt_inicio > $date) {
    array_splice($avisos, 0, 1);
  }

  if ($date >= $dt_fim) {
    array_splice($avisos, 0, 1);
    $db->query('DELETE FROM Tb_aviso WHERE id_aviso=:id_aviso', [
      ':id_aviso' => $aviso['id_aviso']
    ])->get();
  }
}

view('user/avisos.view.php', [
  'avisos' => $avisos,
  'title' => 'Avisos'
]);
