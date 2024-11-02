<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
date_default_timezone_set('America/Sao_Paulo');

$avisos = $db->query('SELECT * FROM Tb_aviso WHERE dt_inicio <= CURDATE() ORDER BY id_aviso DESC')->get();

if (empty($avisos)) {
  view('user/avisos.view.php', [
    'avisos' => 'Nenhum aviso disponível no momento',
    'title' => 'Avisos',
    'noWarnings' => true,
  ]);
  die();
}

$today = date('Y-m-d');

for ($i = 0; $i < count($avisos); $i++) {
  $aviso = $avisos[$i];

  $dt_inicio = $aviso['dt_inicio'];
  $dt_fim = $aviso['dt_fim'];

  $avisos[$i]['dt_inicio'] = date("d/m/y", strtotime($dt_inicio));
  $avisos[$i]['dt_fim'] = date("d/m/y", strtotime($dt_fim));

  if (strtotime($dt_fim) < strtotime($today)) {
    array_splice($avisos, 0, 1);
    $db->query('DELETE FROM Tb_aviso WHERE id_aviso=:id_aviso', [
      ':id_aviso' => $aviso['id_aviso']
    ])->get();
    continue;
  }
}

view('user/avisos.view.php', [
  'avisos' => $avisos,
  'title' => 'Avisos'
]);
