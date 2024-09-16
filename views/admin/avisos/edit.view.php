<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Avisos Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/admin/avisos/style.css">

  <script src="/js/admin/avisos/avisos.js" defer></script>
</head>

<body>
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
    <form method="post" action="/admin/avisos/update" enctype="multipart/form-data" id="form">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id_aviso" value="<?= $aviso['id_aviso'] ?>">

      <h1>Editar Aviso</h1>

      <div id="inputs__div">
        <div id="tituloecorpo" class="form__sections">
          <div id="titulo__div" class="form__sections__div">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="<?= $aviso['titulo'] ?>" id="titulo" />

            <p
              <?= isset($errors['titulo']) ? '' : 'style="display: none" aria-disabled="true"' ?>
              id="tituloMensagem" class="mensagem__erro">
              <?php if (isset($errors['titulo'])) : ?>
                <?= $errors['titulo'] ?>
              <?php endif; ?>
            </p>
          </div>

          <div class="form__sections__div">
            <label for="corpo">Corpo</label>
            <textarea name="corpo" id="corpo" rows="8"><?= $aviso['corpo'] ?></textarea>
          </div>
        </div>

        <div id="datas" class="form__sections">

          <div id="datapostagem__div" class="form__sections__div">
            <label for="dt_inicio">Data da Postagem</label>
            <input type="date" name="dt_inicio" id="data1" value="<?= $aviso['dt_inicio'] ?>">

            <p
              <?= isset($errors['data1']) ? '' : 'style="display: none" aria-disabled="true"' ?>
              id="data1Mensagem" class="mensagem__erro">
              <?php if (isset($errors['data1'])) : ?>
                <?= $errors['data1'] ?>
              <?php else: ?>
                Adicione a data de postagem
              <?php endif; ?>
            </p>
          </div>

          <div id="dataexpiracao__div" class="form__sections__div">
            <label for="dt_fim">Data de expiração</label>
            <input type="date" name="dt_fim" id="data2" value="<?= $aviso['dt_fim'] ?>">

            <p
              <?= isset($errors['data2']) ? '' : 'style="display: none" aria-disabled="true"' ?>
              id="data2Mensagem" class="mensagem__erro">
              <?php if (isset($errors['data2'])) : ?>
                <?= $errors['data2'] ?>
              <?php else: ?>
                Adicione a data de expiração
              <?php endif; ?>
            </p>
          </div>
        </div>
      </div>

      <p id="acoes__div">
        <button type="button" id="deletaraviso__botao">Excluir</button>
        <a href="/admin/avisos">Voltar</a>
        <input type="submit" value="Salvar">
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