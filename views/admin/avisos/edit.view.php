<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/admin/avisos/style.css">
<link rel="stylesheet" type="text/css" href="/css/admin/popup.css">

<script src="/js/admin/avisos/avisos.js" defer="true"></script>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_admin.php') ?>

  <main>
    <form method="post" action="/admin/avisos/update" enctype="multipart/form-data" id="form" data-editing="true">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id_aviso" value="<?= $aviso['id_aviso'] ?>">

      <div id="title">
        <a href="/admin/avisos" class="icons nomargin left" title="voltar"></a>
        <h1>Editar Aviso</h1>
      </div>

      <div id="inputs__div">
        <div id="tituloecorpo" class="form__sections">
          <div id="titulo__div" class="form__sections__div">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="<?= ifOldValid(old('titulo'), $aviso['titulo']) ?>" id="titulo" />

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
            <textarea name="corpo" id="corpo" rows="8"><?= ifOldValid(old('corpo'), $aviso['corpo']) ?></textarea>
          </div>
        </div>

        <div id="datas" class="form__sections">

          <div id="datapostagem__div" class="form__sections__div">
            <label for="dt_inicio" class="icons calendar calendar-plus">Data da Postagem</label>
            <input type="date" name="dt_inicio" id="dt_inicio" value="<?= ifOldValid(old('dt_inicio'), $aviso['dt_inicio']) ?>" disabled>

            <p id="dt_inicio__mensagem" class="mensagem__erro">
              Você não pode mudar a data de postagem
            </p>
          </div>

          <div id="dataexpiracao__div" class="form__sections__div">
            <label for="dt_fim" class="icons calendar calendar-xmark">Data de expiração</label>
            <input type="date" name="dt_fim" id="dt_fim" value="<?= ifOldValid(old('dt_fim'), $aviso['dt_fim']) ?>">

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
        <button type="button" id="deletaraviso__botao" class="icons trash">Excluir</button>
        <button type="submit" class="icons save">Salvar</button>
      </p>
    </form>
    <form method="post" action="/admin/avisos/delete" enctype="multipart/form-data" style="display: none;" aria-disabled="true" id="deletar">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id_aviso" value="<?= $aviso['id_aviso'] ?>">
      <button type="submit">Excluir</button>
    </form>
  </main>
</body>

</html>