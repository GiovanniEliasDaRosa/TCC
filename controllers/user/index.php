<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$turmas = $db->query("SELECT MIN(id_horario) AS id_horario, turma
FROM `Tb_horario`
GROUP BY turma
ORDER BY id_horario")->get();

$userselected = false;
$selectedClass = '1ºA';
$selectClasses = "";
$classesOnScreen = array();

if (isset($_POST['selectedClass'])) {
  if ($_POST['selectedClass'] != null) {
    $selectedClass = $_POST['selectedClass'];
    $userselected = true;
  }
}


foreach ($turmas as $data) {
  if ($userselected && $selectedClass == $data['turma']) {
    $selectClasses .= "<option value='" . $data['turma'] . "' selected>" . $data['turma'] . "</option>";
  } else {
    $selectClasses .= "<option value='" . $data['turma'] . "'>" . $data['turma'] . "</option>";
  }
}

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

for ($col = 0; $col < 5; $col++) {
  $currentday = $days[$col];

  $current = array();
  $current['open'] = '';
  if ($getpossay == $col) {
    $current['open'] = 'active';
  }

  $current['day'] = $dayShow[$col];
  $result = '<table>';

  for ($time = 0; $time < $classes; $time++) {
    if ($time == $break) {
      $result .= "<tr><td>$breakHour</td><td>Intervalo</td></tr>";
    }

    $result .= '<tr><td>' . $datagot[$time]['horario'] . '</td>';
    $result .= '<td>' . $datagot[$time][$currentday] . '</td></tr>';
  }
  $result .= '</table>';
  $current['content'] = $result;

  array_push($classesOnScreen, $current);
}

view('user/index.view.php', [
  'selectClasses' => $selectClasses,
  'classesOnScreen' => $classesOnScreen
]);
