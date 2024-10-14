<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/user/cronograma.css" />

<script src="/js/user/cronograma.js" defer="true"></script>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>

  <main>
    <?php if (!isset($emptyDB)) : ?>
      <form action="/search" method="POST" enctype="multipart/form-data" id="form">
        <p>Selecione uma turma</p>
        <div id="custom-select" class="buttons">
          <select name='selectedClass' id='selectedClass' data-selected="<?= $selectedClass ?>">
            <?= $selectClasses ?>
          </select>
        </div>

      </form>
    <?php endif; ?>

    <div class="container">
      <?php if (isset($emptyDB)) : ?>
        <p id="noData">
          <?= $information ?>
        </p>
      <?php else: ?>
        <?php foreach ($classesOnScreen as $currentDay) : ?>
          <div class="accordion" <?= $currentDay['open'] ?>>
            <button class="accordion-hearder">
              <span><?= $currentDay['day'] ?></span>
              <i class="icons nomargin down"></i>
            </button>

            <div class="accordion-body">
              <?= $currentDay['content'] ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
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