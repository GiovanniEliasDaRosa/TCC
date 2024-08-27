<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$selectedClass = "1ºA";
$select = "";
$table = "";

$turmas = $db->query("SELECT MIN(id_horario) AS id_horario, turma
FROM `Tb_horario`
GROUP BY turma
ORDER BY id_horario")->get();

// $selectedClass = '1ºA';
$userselected = false;
$selectedClass = '1ºA';
if (isset($_POST['selected'])) {
  if ($_POST['selected'] != null) {
    $selectedClass = $_POST['selectedClass'];
    $userselected = true;
  }
}

$select .= "<form action'/' method='post'><select name='selectedClass' id='selectedClass'>";

foreach ($turmas as $data) {
  if ($userselected && $selectedClass == $data['turma']) {
    $select .= "<option value='" . $data['turma'] . "' selected>" . $data['turma'] . "</option>";
  } else {
    $select .= "<option value='" . $data['turma'] . "'>" . $data['turma'] . "</option>";
  }
}

$select .= "<input type='submit' value='selecionar' name='selected'
</select>
<form>";

$datagot = $db->query(
  'SELECT * FROM Tb_horario WHERE turma = :turma',
  [
    ':turma' => $selectedClass
  ]
)->get();

$days = [
  "segunda",
  "terca",
  "quarta",
  "quinta",
  "sexta",
];

$getpossay = 0;

// When getting from post, use New Date(); from JS
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

$dayShow = [
  "Segunda",
  "Terça",
  "Quarta",
  "Quinta",
  "Sexta",
];

$isNight = false;
$classes = 7;
$breakHour = '10:00';
$break = 4;

if ($datagot[0]['horario'] != "07:00") {
  $isNight = true;
  $classes = 5;
  $break = 2;
  $breakHour = '20:30';
}

echo "<h1>Searching from class $selectedClass</h1>";
for ($col = 0; $col < 5; $col++) {
  $currentday = $days[$col];
  $open = '';
  if ($getpossay == $col) {
    $open = 'open';
  }

  echo "<details $open>
  <summary>" . $dayShow[$col] . "</summary>
  <table>";

  for ($time = 0; $time < $classes; $time++) {
    if ($time == $break) {
      echo "<tr><td>$breakHour</td><td>Intervalo</td></tr>";
    }

    echo "<tr><td>" . $datagot[$time]['horario'] . "</td>";
    echo "<td>" . $datagot[$time][$currentday] . "</td></tr>";
  }

  // echo "<tr><td colspan='2'>$row</td></tr>";
  echo "</table></details>";
}

view('user/index.view.php', [
  'select' => $select,
  'table' => $table
]);
