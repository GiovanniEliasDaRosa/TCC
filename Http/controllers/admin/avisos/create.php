<?php

use Core\Session;

date_default_timezone_set('America/Sao_Paulo');

$saved = Session::has('saved');
view('admin/avisos/create.view.php', [
  'errors' => Session::get('errors'),
  'saved' => $saved,
  'title' => 'Adicionar Avisos Admin'
]);
