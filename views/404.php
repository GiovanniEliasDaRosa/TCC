<?php
$title = "Página não encontrada";
$headerSelected = "none";
require(BASE_PATH . '/views/partials/head.php')
?>

<link rel="stylesheet" type="text/css" href="/css/404error.css">
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>
  <main>
    <img src="/img/404/404error-<?= getTheme() ?>.png" alt="Alguém perdido em pixel art" id="error__img">
    <h1 id="error">404</h1>
    <h1>Página não encontrada</h1>
    <a href="/">Ir para o menu principal.</a>
  </main>
  <?php require(BASE_PATH . '/views/partials/footer.php') ?>