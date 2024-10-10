<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
date_default_timezone_set('America/Sao_Paulo');

function saveSelectedClass($selectedClass)
{
  $days = time() + 60 * 60 * 24 * 30; // 30 days
  $params = session_get_cookie_params();
  setcookie('selectedClass', $selectedClass, [
    'expires' => $days,
    'path' => $params['path'],
    'domain' => $params['domain'],
    'secure' => $params['secure'],
    'httponly' => $params['httponly'],
    'samesite' => 'Strict',
  ]);
}

$turmas = $db->query("SELECT MIN(id_horario) AS id_horario, turma
FROM `Tb_horario`
GROUP BY turma
ORDER BY id_horario")->get();

$selectedClass = '1ºA';
$selectClasses = '';
$classesOnScreen = array();
$validCookie = false;


// No class to be selected, that means that there is no data on SQL
if (empty($turmas)) {
  view('user/index.view.php', [
    'information' => 'Nenhum cronograma cadastrado',
    'lastWarning' => 'none',
    'headerSelected' => 'cronogram',
    'title' => 'Horários',
    'emptyDB' => true,
    'selectedClass' => $selectedClass
  ]);
  die();
}

if (isset($_POST['selectedClass'])) {
  // Loaded from POST
  if ($_POST['selectedClass'] != null) {
    $selectedClass = $_POST['selectedClass'];
  }
  saveSelectedClass($selectedClass);
} else if (isset($_COOKIE['selectedClass']) && $_COOKIE['selectedClass'] != '') {
  // Loaded from GET
  $savedSelectedClass = $_COOKIE['selectedClass'];
  foreach ($turmas as $data) {
    if ($data['turma'] == $savedSelectedClass) {
      $validCookie = true;
      $selectedClass = $savedSelectedClass;
      saveSelectedClass($selectedClass);
      break;
    }
  }
}

foreach ($turmas as $data) {
  if ($selectedClass == $data['turma']) {
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
      $result .= "<tr class='break'><td>$breakHour</td><td>Intervalo</td></tr>";
    }

    $result .= '<tr><td>' . $datagot[$time]['horario'] . '</td>';
    $result .= '<td>' . $datagot[$time][$currentday] . '</td></tr>';
  }
  $result .= '</table>';
  $current['content'] = $result;

  array_push($classesOnScreen, $current);
}

$lastAdQuery = $db->query('SELECT * FROM `tb_aviso` WHERE dt_inicio <= CURDATE() ORDER BY id_aviso DESC')->get();

if (empty($lastAdQuery)) {
  $lastWarning = 'none';
} else {
  $lastWarning = $lastAdQuery[0]["id_aviso"];
}

view('user/index.view.php', [
  'selectClasses' => $selectClasses,
  'classesOnScreen' => $classesOnScreen,
  'lastWarning' => $lastWarning,
  'headerSelected' => 'cronogram',
  'title' => 'Horários',
  'selectedClass' => $selectedClass
]);
