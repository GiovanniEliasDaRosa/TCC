<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$selectedClass = "1ºA";

$cronograma = $db->query(
  'SELECT * FROM Tb_horario WHERE turma = :turma',
  [
    ':turma' => $selectedClass
  ]
)->get();

$userselected = false;
$selectedClass = '1ºA';
if (isset($_POST['selected'])) {
  if ($_POST['selected'] != null) {
    $selectedClass = $_POST['selectedClass'];
    $userselected = true;
  }
}

echo "<form action'' method='post'><select name='selectedClass' id='selectedClass'>";

while ($data = mysqli_fetch_assoc($query)) {
  if ($userselected && $selectedClass == $data['turma']) {
    echo "<option value='" . $data['turma'] . "' selected>" . $data['turma'] . "</option>";
  } else {
    echo "<option value='" . $data['turma'] . "'>" . $data['turma'] . "</option>";
  }
}

echo "<input type='submit' value='selecionar' name='selected'
</select>
<form>";

$table = "";

$days = [
  'Segunda',
  'Terca',
  'Quarta',
  'Quinta',
  'Sexta'
];

$getpossay = 0;

$todaysdate = getdate()["weekday"];

if ($todaysdate == "Saturday" || $todaysdate == "Sunday" || $todaysdate == "Monday") {
  $getpossay = 0;
} else if ($todaysdate == "Tuesday") {
  $getpossay = 1;
} else if ($todaysdate == "Wednesday") {
  $getpossay = 2;
} else if ($todaysdate == "Thursday") {
  $getpossay = 3;
} else if ($todaysdate == "Friday") {
  $getpossay = 4;
}

$table .= "<h1>$selectedClass</h1>";

for ($currentday = 0; $currentday < 5; $currentday++) {
  $day = $days[$currentday];

  // $data = '';
  // $open = '';
  // if ($getpossay == $currentday) {
  //   $open = 'open';
  // }
  $rows = count($cronograma[0]) - 3;

  // $table .= "<details $open>
  // <summary>$day</summary>
  // <table>";
  // $table .= "<tr><td colspan='2'>$day</td></tr>";

  $table .= "<h1>$day</h1>";
  $table .= "<table><tr><td colspan='2'>$day</td></tr>";

  for ($row = 0; $row < 1; $row++) {
    $table .= "<tr>";
    $data = $cronograma[$row];

    $pos = [
      $data['horario'],
      $data[strtolower($day)]
    ];


    for ($col = 0; $col < $rows; $col++) {
      $data = $cronograma[$row];

      $table .= "<td>";
      $table .= $data[strtolower($day)];
      $table .= "</td>";
    }
    $table .= "</tr>";
  }

  if ($row == 0) {
    $table .= "<tr><td>No data has been found</td></tr>";
  }
  $table .= "</table>";
  // $table .= "</table></details>";
}

view('user/index.view.php', [
  'select' => $select,
  'table' => $table
]);
