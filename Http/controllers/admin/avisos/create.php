<?php
date_default_timezone_set('America/Sao_Paulo');

function futuro($dias)
{
  $date = date_create(date('Y-m-d'));
  date_add($date, date_interval_create_from_date_string("$dias days"));
  return date_format($date, 'Y-m-d');
}

view('admin/avisos/create.view.php', [
  'data' => date('Y-m-d'),
  'expiracao' => futuro(7),
  'errors' => []
]);
