<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = $db->query('SELECT * FROM Tb_horario')->get();

if (empty($query)) {
  header('location: /admin/update');
  exit();
}

// Import autoload file from the library PHPSpreadsheet
require_once base_path('controllers/admin/cronograma/api/vendor/autoload.php');

// Import coordinate from the libary
use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;
// Import ability to read excel files from the libary
use \PhpOffice\PhpSpreadsheet\IOFactory;

$path = base_path('controllers/admin/cronograma/horario.xlsx');
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

array_splice($queries, 0, 1);

foreach ($queries as $currentquery) {
  $db->query($currentquery)->get();
}

header('Location: /admin');
