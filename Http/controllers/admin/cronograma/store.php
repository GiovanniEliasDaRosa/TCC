<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\CronogramForm;

$db = App::resolve(Database::class);

$query = $db->query('SELECT * FROM Tb_horario')->get();

if (!empty($data)) {
  abort();
}

// Validates the uploaded file
$cronogramForm = new CronogramForm();

$work = $cronogramForm->getWork();
$lastRow = $cronogramForm->getLastRow();
$lastColumn = $cronogramForm->getLastColumn();

$query = "INSERT INTO Tb_horario (horario, turma, segunda, terca, quarta, quinta, sexta) VALUES ";

for ($row = 2; $row <= $lastRow; $row++) {
  $query .= "(";

  for ($col = 1; $col <= $lastColumn; $col++) {
    $value = $work->getCell([$col, $row])->getCalculatedValue();
    if ($col != 7) {
      $query .= "'$value',";
    } else {
      $query .= "'$value'";
    }
  }
  if ($row != $lastRow) {
    $query .= "),\n";
  } else {
    $query .= ")";
  }
}

$response = $db->query($query)->get();

unlink(base_path("public/uploads/horario.xlsx"));

Session::put('saved', true);

// redirect('/admin');
header('location: /admin');
die();
