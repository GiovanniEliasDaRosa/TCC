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

$response = $con->query("SELECT * FROM Tb_horario");

if ($response->num_rows == 0) {
  // Doesn't have data, then add
  $response = $con->query($query);
}

header('Location: index.php');
