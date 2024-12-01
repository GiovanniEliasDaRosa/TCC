<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/admin/avisos/style.css">
<link rel="stylesheet" type="text/css" href="/css/admin/popup.css">
<script src="/js/admin/avisos/avisos.js" defer="true"></script>
</head>

<body>
  <?php if ($saved) : ?>
    <div id="popup__saved">
      Aviso adicionado com sucesso!
    </div>
  <?php endif; ?>

  <?php require(BASE_PATH . '/views/partials/header_admin.php') ?>

  <main>
    <form method="post" action="/admin/avisos/new" enctype="multipart/form-data" id="form">
      <div id="title">
        <a href="/admin/avisos" class="icons nomargin left" title="voltar"></a>
        <h1>Adicionar Aviso</h1>
      </div>

      <div id="inputs__div">
        <div id="tituloecorpo" class="form__sections">
          <div id="titulo__div" class="form__sections__div">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="<?= old('titulo') ?? '' ?>" id="titulo" />

            <p
              <?= isset($errors['titulo']) ? '' : 'style="display: none" aria-disabled="true"' ?>
              id="titulo__mensagem" class="mensagem__erro">
              <?php if (isset($errors['titulo'])) : ?>
                <?= $errors['titulo'] ?>
              <?php endif; ?>
            </p>
          </div>

          <div class="form__sections__div">
            <label for="corpo">Corpo</label>
            <textarea name="corpo" id="corpo" rows="8"><?= old('corpo') ?? '' ?></textarea>
          </div>
        </div>

        <div id="datas" class="form__sections">

          <div id="datapostagem__div" class="form__sections__div">
            <label for="dt_inicio" class="icons calendar calendar-plus">Data da Postagem</label>
            <input type="date" name="dt_inicio" id="dt_inicio" value="<?= old('dt_inicio') ?>">

            <p
              <?= isset($errors['dt_inicio']) ? '' : 'style="display: none" aria-disabled="true"' ?>
              id="dt_inicio__mensagem" class="mensagem__erro">
              <?php if (isset($errors['dt_inicio'])) : ?>
                <?= $errors['dt_inicio'] ?>
              <?php else: ?>
                Adicione a data de postagem
              <?php endif; ?>
            </p>
          </div>

          <div id="dataexpiracao__div" class="form__sections__div">
            <label for="dt_fim" class="icons calendar calendar-xmark">Data de expiração</label>
            <input type="date" name="dt_fim" id="dt_fim" value="<?= old('dt_fim') ?>">

            <p
              <?= isset($errors['dt_fim']) ? '' : 'style="display: none" aria-disabled="true"' ?>
              id="dt_fim__mensagem" class="mensagem__erro">
              <?php if (isset($errors['dt_fim'])) : ?>
                <?= $errors['dt_fim'] ?>
              <?php else: ?>
                Adicione a data de expiração
              <?php endif; ?>
            </p>
          </div>
        </div>
      </div>

      <p id="acoes__div">
        <button type="submit" class="icons save">Salvar</button>
      </p>
    </form>
  </main>
</body>

</html>