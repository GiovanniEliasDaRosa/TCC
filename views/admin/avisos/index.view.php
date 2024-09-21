<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avisos Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
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

  <header>
    <div class="logo__header">
      <img src="/img/logo.png" alt="logo" />
    </div>
    <h1>Tela administrativa</h1>
    <div class="navegacao__header">
      <a class="navegacao__header__button" href="/admin">Horários</a>
      <a class="navegacao__header__button active" href="/admin/avisos">Avisos</a>

      <form method="post" action="/logout" enctype="multipart/form-data">
        <button type="submit" class="botao" id="deslog">Sair</button>
      </form>
    </div>
  </header>

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