<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/user/avisos.css" />

  <script src="js/avisos.js" defer></script>
</head>

<body>
  <header>
    <div class="logo__header">
      <img src="img/logo.png" alt="logo" />
    </div>
    <div class="navegacao__header">
      <a class="navegacao__header__button" href="/">Horários</a>
      <a class="navegacao__header__button active" href="/avisos" id="navegacao__header__avisos">Avisos</a>
    </div>
  </header>

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
    <div id="popUpAviso__header">
      <button class="icons nomargin xmark" id="popUpAviso__header__close"></button>

      <h2 id="popUpAviso__header__title">Não Haverá aula Amanhã</h2>
    </div>
    <p id="popUpAviso__content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum aliquam repudiandae qui quod soluta illo quos possimus quae quisquam, natus sint ea, quidem voluptate? Autem rerum non voluptatibus provident quasi.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi officiis error, tenetur ullam nemo enim repellendus, fugiat recusandae.
      Cum neque placeat natus earum doloremque sint quae deserunt obcaecati dignissimos beatae.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi officiis error, tenetur ullam nemo enim repellendus, fugiat recusandae cum neque placeat natus earum doloremque sint quae deserunt obcaecati dignissimos beatae.
    </p>
  </div>
</body>

</html>