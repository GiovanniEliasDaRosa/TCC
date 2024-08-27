<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Avisos Admin</title>
</head>

<body>
  <form method="post" action="/admin/avisos/update" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id_aviso" value="<?= $aviso['id_aviso'] ?>">

    <h1>Editar Aviso</h1>

    <p><label for="titulo">Título</label>
      <input type="text" name="titulo" value="<?= $aviso['titulo'] ?>" required />
      <?php if (isset($errors['titulo'])) : ?>
        <p><?= $errors['titulo'] ?></p>
      <?php endif; ?>
    </p>

    <p><label for="corpo">Corpo</label>
      <textarea name="corpo"><?= $aviso['corpo'] ?></textarea>
    </p>

    <p><label for="dt_inicio">Data da Postagem</label>
      <input type="date" name="dt_inicio" value="<?= $aviso['dt_inicio'] ?>" required>
    </p>

    <p><label for="dt_fim">Data de expiração</label>
      <input type="date" name="dt_fim" value="<?= $aviso['dt_fim'] ?>" required>
    </p>

    <p>
      <a href="/admin/avisos">Voltar</a>
      <input type="submit" value="Salvar">
    </p>
  </form>
</body>

</html>