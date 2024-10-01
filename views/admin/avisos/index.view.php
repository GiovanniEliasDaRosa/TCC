<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/admin/avisos/style.css">
<link rel="stylesheet" type="text/css" href="/css/admin/avisos/menu.css">

<script src="/js/admin/avisos/popupavisos.js" defer></script>
</head>

<body>
  <?php if ($saved) : ?>
    <div id="popup__saved">
      Aviso salvo com sucesso!
      <button class="icons square nomargin xmark" id="popup__button"></button>
    </div>
  <?php endif; ?>

  <?php require(BASE_PATH . '/views/partials/header_admin.php') ?>

  <main>
    <a href='/admin/avisos/new' class='icons plus' id="adicionar">Adicionar aviso</a>

    <?php foreach ($avisos as $aviso) : ?>
      <div class="avisos__div">
        <div class="avisos__div__info">
          <strong class="avisos__div__info__titulo"><?= $aviso['titulo'] ?></strong>
          <p class="avisos_div_dates">
            <span class="icons calendar calendar-plus">Postagem: <span class="avisos_div_dates_date"><?= $aviso['dt_inicio'] ?></span></span>
            <span class="icons calendar calendar-xmark">Exclusão: <span class="avisos_div_dates_date"><?= $aviso['dt_fim'] ?></span></span>
          </p>

        </div>
        <a href="/admin/avisos/edit?id=<?= $aviso['id_aviso'] ?>">Editar</a>
      </div>
    <?php endforeach; ?>

  </main>
</body>

</html>