<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/user/cronograma.css" />

  <script src="js/cronograma.js" defer></script>
</head>

<body>
  <header>
    <div class="logo__header">
      <img src="img/logo.png" alt="logo" />
    </div>
    <div class="navegacao__header">
      <a class="navegacao__header__button active" href="/">Horários</a>
      <a class="navegacao__header__button" href="/avisos" id="navegacao__header__avisos">Avisos</a>
    </div>
  </header>

  <main>
    <form action="/" method="POST" enctype="multipart/form-data">
      <select name='selectedClass' id='selectedClass'>
        <?= $selectClasses ?>
      </select>
      <button type="submit">Selecionar</button>
    </form>

    <div class="container">
      <?php foreach ($classesOnScreen as $currentDay) : ?>
        <div class="accordion">
          <button class="accordion-hearder">
            <span><?= $currentDay['day'] ?></span>
            <i class="icons nomargin down"></i>
          </button>

          <div class="accordion-body <?= $currentDay['open'] ?>">
            <?= $currentDay['content'] ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <p style="display: none;" aria-disabled="true" id="ultimoAviso"><?= $lastAd ?></p>

  <script>
    let ultimoAviso = document.querySelector('#ultimoAviso')
    let ultimoAvisoVisto = localStorage.getItem("lastWarningSaw");

    if (ultimoAviso.textContent != ultimoAvisoVisto && ultimoAviso.textContent != 'none') {
      navegacao__header__avisos.setAttribute("data-warning", "true");
    }
  </script>
</body>

</html>

<!-- # Allow access to files in the public directory

RewriteCond %{REQUEST_URI} ^/css/ [OR]
RewriteCond %{REQUEST_URI} ^/js/ [OR]
RewriteCond %{REQUEST_URI} ^/img/
RewriteRule ^ - [L]

# Route all other requests to index.php -->