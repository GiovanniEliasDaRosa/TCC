<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\CronogramForm;

$db = App::resolve(Database::class);

$query = $db->query('SELECT * FROM Tb_horario')->get();

if (empty($query)) {
  abort();
}

// Validates the uploaded file
$cronogramForm = new CronogramForm();

$work = $cronogramForm->getWork();
$lastRow = $cronogramForm->getLastRow();
$lastColumn = $cronogramForm->getLastColumn();

$queries = array();
$columnsItems = [
  "",
  "horario",
  "turma",
  "segunda",
  "terca",
  "quarta",
  "quinta",
  "sexta"
];

for ($row = 1; $row <= $lastRow; $row++) {
  $query = "UPDATE Tb_horario SET ";
  echo "<tr>";
  for ($col = 1; $col <= $lastColumn; $col++) {
    $value = $work->getCell([$col, $row])->getCalculatedValue();
    $valueatpos = $columnsItems[$col];
    if ($col != 7) {
      $query .= "$valueatpos='$value',";
    } else {
      $query .= "$valueatpos='$value'";
    }
  }
  $query .= " WHERE id_horario = " . $row - 1;

  array_push($queries, $query);
}

array_splice($queries, 0, 1);

foreach ($queries as $currentquery) {
  $db->query($currentquery)->get();
}

unlink(base_path("public/uploads/horario.xlsx"));

Session::put('saved', true);

// header('Location: /admin');
header('location: /admin');
die();
