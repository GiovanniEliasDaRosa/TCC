<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/user/avisos.css" />

<script src="/js/user/avisos.js" defer></script>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>

  <main>
    <div id="avisos">
      <?php foreach ($avisos as $aviso) : ?>
        <div class="aviso" data-id="<?= $aviso['id_aviso'] ?>">
          <p>
            <strong class="aviso__title"><?= $aviso['titulo'] ?></strong>
            <span class="aviso__content" style="display: none;" aria-disabled="true"><?= htmlspecialchars($aviso['corpo']) ?></span>
            <span><?= $aviso['dt_fim'] ?></span>
          </p>

          <?php if ($aviso['corpo'] !== '') : ?>
            <button class="popUpAviso__header__open">Ler mais</button>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <div id="popUpAviso" style="display: none;" aria-disabled="true">
    <div id="popUpAviso__div">
      <div id="popUpAviso__header">
        <button class="icons nomargin xmark" id="popUpAviso__header__close"></button>
        <h2 id="popUpAviso__header__title">Titulo</h2>
      </div>
      <p id="popUpAviso__content">Conteudo</p>
    </div>
  </div>