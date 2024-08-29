<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cronograma Admin</title>
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
  <h1>Cronograma Admin</h1>

  <form method="post" action="/logout" enctype="multipart/form-data">
    <button type="submit">Log out</button>
  </form>

  <?= $result['link'] ?>

  <?= $result['data'] ?>
</body>

</html>