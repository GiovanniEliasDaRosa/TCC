<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
date_default_timezone_set('America/Sao_Paulo');

$avisos = $db->query('SELECT * FROM Tb_aviso ORDER BY id_aviso DESC')->get();

$today =  date("Y-m-d");
$pos = 0;

foreach ($avisos as $aviso) {
  $dt_inicio = $aviso['dt_inicio'];
  $dt_fim = $aviso['dt_fim'];
  $avisos[$pos]['dt_inicio'] = date("d/m/y", strtotime($dt_inicio));
  $avisos[$pos]['dt_fim'] = date("d/m/y", strtotime($dt_fim));
  $avisos[$pos]['activeforusers'] = '';

  if (strtotime($dt_inicio) > strtotime($today)) {
    $avisos[$pos]['activeforusers'] = 'inactivewarning';
  }

  if (strtotime($dt_fim) < strtotime($today)) {
    array_splice($avisos, 0, 1);
    $db->query('DELETE FROM Tb_aviso WHERE id_aviso=:id_aviso', [
      ':id_aviso' => $aviso['id_aviso']
    ])->get();
  }
  $pos++;
}
$saved = Session::has('saved');

view('admin/avisos/index.view.php', [
  'avisos' => $avisos,
  'saved' => $saved,
  'title' => 'Avisos Admin'
]);
