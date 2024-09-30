<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$datagot = $db->query('SELECT * FROM Tb_horario')->get();

if (empty($datagot)) {
  return view('admin/cronograma/index.view.php', [
    'result' => [
      'data' => "<p style='font-weight: 900' id='noData'>Não há um cronograma salvo, adicione um</p>",
      'link' => "<a href='/admin/new'>Adicionar</a>",
    ],
    'headerSelected' => true,
    'title' => 'Cronograma Admin'
  ]);
  exit();
}

$dataclasses = $db->query('SELECT MIN(id_horario) AS id_horario, turma
FROM `Tb_horario`
GROUP BY turma
ORDER BY id_horario')->get();

$classes = array();
$posstartnightclass = 0;
$lastclass = 0;
$pos = 0;

foreach ($dataclasses as $data) {
  $thisclass = intval(substr($data['turma'], 0, 1));
  if ($thisclass < $lastclass && $posstartnightclass == 0) {
    $posstartnightclass = $pos;
  }
  array_push($classes, $data['turma']);
  $lastclass = $thisclass;
  $pos++;
}

$days = [
  "segunda",
  "terca",
  "quarta",
  "quinta",
  "sexta",
];

$dayShow = [
  "Segunda",
  "Terça",
  "Quarta",
  "Quinta",
  "Sexta",
];

$times = [
  '07:00',
  '07:45',
  '08:30',
  '09:15',
  '10:20',
  '11:05',
  '11:50',
];

$nighttimes = [
  '19:00',
  '19:45',
  '20:50',
  '21:35',
  '22:15',
];

$tables = ["", ""];

// Repeate for 2 tables day and night
for ($i = 0; $i < 2; $i++) {
  $tables[$i] .= "<table>";
  $classStart = 0;
  $quantClasses = $posstartnightclass;

  if ($i == 1) {
    // if night
    $night = true;
    $quantClasses = count($classes);
    $classStart = $posstartnightclass;

    $tables[$i] .= "<tr><td class='dayNight' colspan='$quantClasses'>Noite</td></tr>";
  } else {
    // if day
    $night = false;
    $tables[$i] .= "<tr><td class='dayNight' colspan='" . $quantClasses + 1 . "'>Manhã</td></tr>";
  }

  // For each day
  for ($day = 0; $day < 5; $day++) {
    $currentDay = $days[$day];

    $tables[$i] .= "<tr><td class='newday' colspan='17'>" . $dayShow[$day] . "</td></tr>";
    $tables[$i] .= "<td>horario</td>";
    for ($class = $classStart; $class < $quantClasses; $class++) {
      $currentClass = $classes[$class];
      $tables[$i] .= "<td>$currentClass</td>";
    }

    for ($time = 0; $time < 7; $time++) {
      if (!$night && $time == 4) {
        $tables[$i] .= "<tr class='break'><td>10:00:00</td><td colspan='$quantClasses'>Intervalo</td></tr><tr>";
      } else if ($night && $time == 2) {
        $tables[$i] .= "<tr class='break'><td>20:30:00</td><td colspan='$quantClasses'>Intervalo</td></tr><tr>";
      } else {
        $tables[$i] .= "<tr>";
      }

      for ($class = $classStart; $class < $quantClasses; $class++) {
        $currentClass = $classes[$class];
        if ($night) {
          $selectedtime = $nighttimes;
        } else {
          $selectedtime = $times;
        }

        if ($class == $classStart) {
          if ($night) {
            if ($time > count($selectedtime) - 1) {
              $tables[$i] .= "<td></td><td></td>";
              continue;
            } else {
              $tables[$i] .= "<td>" . $selectedtime[$time] . "</td>";
            }
          } else {
            $tables[$i] .= "<td>" . $selectedtime[$time] . "</td>";
          }
        }

        if ($time > count($selectedtime) - 1) {
          $tables[$i] .= "<td></td>";
          continue;
        }

        for ($allData = 0; $allData < count($datagot); $allData++) {
          $currentAllDataClass = $datagot[$allData];

          if ($currentAllDataClass["horario"] == $selectedtime[$time] && $currentAllDataClass["turma"] == $currentClass) {
            $tables[$i] .= "<td>" . $currentAllDataClass[$currentDay] . "</td>";
          }
        }
      }
      $tables[$i] .= "</tr>";
    }
  }
  $tables[$i] .= "</table>";
}

$result = [];

return view('admin/cronograma/index.view.php', [
  'result' => [
    'data' => "<div id='tables'>" . $tables[0] . $tables[1] . "</div>",
    'link' => "<a href='/admin/update'>Atualizar</a>",
  ],
  'headerSelected' => true,
  'title' => 'Cronograma Admin'
]);
