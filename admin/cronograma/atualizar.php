<?php

// Import connection to DB, if an error occurs the rest of the whole project will fail
require_once '../../conexao.php';

// Import autoload file from the library PHPSpreadsheet
require_once 'api/vendor/autoload.php';

// Import coordinate from the libary
use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;
// Import ability to read excel files from the libary
use \PhpOffice\PhpSpreadsheet\IOFactory;

$path = "horario.xlsx";
$spreadsheet = IOFactory::load($path);

$reader = IOFactory::createReaderForFile($path);
$reader->setReadDataOnly(true);

$loadedfile = $reader->load($path);
$work = $loadedfile->getSheet('1');

$lastRow = $work->getHighestRow();
$columnCount = $work->getHighestDataColumn();

$lastColumn = Coordinate::columnIndexFromString($columnCount);

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

$response = $con->query("SELECT * FROM Tb_horario");

if ($response->num_rows == 0) {
  $response = $con->query($query);
}


if ($response->num_rows > 0) {
  // Has data, then update it
  array_splice($queries, 0, 1);

  foreach ($queries as $currentquery) {
    $query = $con->query($currentquery);
    if ($query == 0) {
      echo '<h1>Erro</h1>';
    }
  }

  header('Location: index.php');
} else {
  // Doesn't have data, then redirect to add
  header('Location: adicao.php');
}
