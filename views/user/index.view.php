<?php require(BASE_PATH . '/views/partials/head.php') ?>
<title>Horários</title>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/user/cronograma.css" />

<script src="/js/cronograma.js" defer></script>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>

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

  <p style="display: none;" aria-disabled="true" id="lastWarning"><?= $lastWarning ?></p>

  <script>
    let lastWarning = document.querySelector('#lastWarning')
    let lastWarningSaw = localStorage.getItem("lastWarningSaw");

    if (lastWarning.textContent != lastWarningSaw && lastWarning.textContent != 'none') {
      navegacao__header__avisos.setAttribute("data-warning", "true");
    }
  </script>
  <?php require(BASE_PATH . '/views/partials/footer.php') ?>