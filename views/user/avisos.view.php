<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/user/avisos.css" />

<script src="/js/user/avisos.js" defer="true"></script>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>

  <main>
    <div id="avisos">
      <?php if (isset($noWarnings)) : ?>
        <p id="noData">
          <?= $avisos ?>
        </p>
      <?php else: ?>
        <?php foreach ($avisos as $aviso) : ?>
          <div class="aviso" data-id="<?= $aviso['id_aviso'] ?>">
            <p class="aviso__date__end icons outline calendar calendar-normal"><?= $aviso['dt_fim'] ?></p>
            <p class="aviso__title"><?= $aviso['titulo'] ?></p>

            <p class="aviso__date__start" style="display: none;" aria-disabled="true"><?= $aviso['dt_inicio'] ?></p>
            <p class="aviso__content" style="display: none;" aria-disabled="true"><?= htmlspecialchars($aviso['corpo']) ?></p>

            <?php if ($aviso['corpo'] !== '') : ?>
              <button class="popUpAviso__header__open">Ler mais</button>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>


  <div id="popUpAviso" style="display: none;" aria-disabled="true">
    <div id="popUpAviso__div">
      <div id="popUpAviso__header">
        <button class="icons nomargin xmark" id="popUpAviso__header__close"></button>
        <h2 id="popUpAviso__header__title">Titulo</h2>
      </div>
      <div id="popUpAviso__calendar">
        <p class="icons calendar calendar-plus">Postagem: <span id="popUpAviso__date__start">00/00/00</span></p>
        <p class="icons calendar calendar-xmark">Dia: <span id="popUpAviso__date__end">00/00/00</span></p>
      </div>
      <p id="popUpAviso__content">Conteudo</p>
    </div>
  </div>
  <?php require(BASE_PATH . '/views/partials/footer.php') ?>