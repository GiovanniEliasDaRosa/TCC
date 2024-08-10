<?php
// Import connection to DB, if an error occurs the rest of the whole project will fail
require_once '../../conexao.php';

$sql = "SELECT * FROM tb_horario";
$query = $con->query($sql);
$datagot = array();

while ($data = mysqli_fetch_assoc($query)) {
  array_push($datagot, $data);
}

$sql = "SELECT MIN(id_horario) AS id_horario, turma
FROM `tb_horario`
GROUP BY turma
ORDER BY id_horario";
$query = $con->query($sql);

$classes = array();

$posstartnightclass = 0;
$lastclass = 0;
$pos = 0;

while ($data = mysqli_fetch_assoc($query)) {
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
  '07:00:00',
  '07:45:00',
  '08:30:00',
  '09:15:00',
  '10:20:00',
  '11:05:00',
  '11:50:00',
];

$nighttimes = [
  '19:00:00',
  '19:45:00',
  '20:50:00',
  '21:35:00',
  '22:15:00',
];

$tables = ["", ""];

for ($i = 0; $i < 2; $i++) {
  $tables[$i] .= "<table>";
  $classStart = 0;
  $quantClasses = $posstartnightclass;
  if ($i == 1) {
    $night = true;
    $quantClasses = count($classes);
    $classStart = $posstartnightclass;

    $tables[$i] .= "<tr><td class='dayNight' colspan='$quantClasses'>Noite</td></tr>";
  } else {
    $night = false;
    $tables[$i] .= "<tr><td class='dayNight' colspan='" . $quantClasses + 1 . "'>Manhã</td></tr>";
  }

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

if (empty($classes)) {
  $result['data'] = "<p style='font-weight: 900'><br>Não há um cronograma salvo adicione um</p>";
  $result['link'] = "<a href='adicao.php'>Adicionar</a>";
} else {
  $result['data'] = "<div id='tables'>" . $tables[0] . $tables[1] . "</div>";
  $result['link'] = "<a href='atualizar.php'>Atualizar</a>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cronograma - Vizualizção</title>
  <style>
    body {
      padding: 0.5em;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    table {
      border-spacing: 0;
      border-color: transparent;
    }

    tr:nth-child(odd) {
      background-color: hsl(0, 0%, 95%);
    }

    tr,
    td {
      height: 5rem;
      min-width: 8rem;
    }

    td:first-child {
      border-left: solid 0.2rem hsl(0, 0%, 80%);
    }

    td {
      text-align: center;
      padding-inline: 0.5rem;
      border-right: solid 0.2rem hsl(0, 0%, 80%);
    }

    .dayNight {
      font-size: 1.5rem;
      font-weight: 900;
      height: 4em;
      background-color: hsl(0, 0%, 60%);
      color: white;
    }

    .newday {
      margin-top: 2em;
      font-size: 1.5rem;
      font-weight: 900;
      background-color: hsl(0, 0%, 85%);
    }

    .break {
      background-color: hsl(0, 0%, 80%);
    }

    #tables {
      display: grid;
      grid-template-columns: 8fr 2fr;
      gap: 2em;
    }
  </style>
</head>

<body>
  <h1>Cronograma - Vizualizção</h1>

  <?= $result['link'] ?>

  <?= $result['data'] ?>
</body>

</html>