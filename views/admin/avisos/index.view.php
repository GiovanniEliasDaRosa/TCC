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
    <a href='/admin/avisos/new' id="adicionar">Adicionar aviso</a>

    <?php foreach ($avisos as $aviso) : ?>
      <div class="avisos__div">
        <div class="avisos__div__info">
          <strong class="avisos__div__info__titulo"><?= $aviso['titulo'] ?></strong>
          Postagem: <span><?= $aviso['dt_inicio'] ?></span>
          Exclusão: <span><?= $aviso['dt_fim'] ?></span>
        </div>
        <a href="/admin/avisos/edit?id=<?= $aviso['id_aviso'] ?>">Editar</a>
      </div>
    <?php endforeach; ?>

  </main>
</body>

</html>