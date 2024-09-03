<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = $db->query('SELECT * FROM Tb_horario')->get();

if (!empty($data)) {
  header('location: /admin');
  exit();
}

// autoload file from the library PHPSpreadsheet is already imported on the /public/index.php

// Import coordinate from the libary
use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;
// Import ability to read excel files from the libary
use \PhpOffice\PhpSpreadsheet\IOFactory;

$path = base_path('Http/controllers/admin/cronograma/horario.xlsx');
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

$response = $db->query($query)->get();

header('location: /admin');
