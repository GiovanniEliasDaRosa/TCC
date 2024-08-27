<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Avisos Admin</title>
</head>

<body>
  <form method="post" action="/admin/avisos/new" enctype="multipart/form-data">
    <h1>Adicionar Aviso</h1>

    <p>
      <label for="titulo">Título</label>
      <input type="text" name="titulo" value="<?= $titulo ?? '' ?>" required />
      <?php if (isset($errors['titulo'])) : ?>
        <p><?= $errors['titulo'] ?></p>
      <?php endif; ?>
    </p>
    
    <p>
      <label for="corpo">Corpo</label>
      <textarea name="corpo"><?= $corpo ?? '' ?></textarea>
    </p>

    <p>
      <label for="dt_inicio">Data da Postagem</label>
      <input type="date" name="dt_inicio" value="<?= $data ?? '' ?>" required>
    </p>

    <p>
      <label for="dt_fim">Data de expiração</label>
      <input type="date" name="dt_fim" value="<?= $expiracao ?? '' ?>" required>
    </p>

    <p>
      <a href="/admin/avisos">Voltar</a>
      <input type="submit" value="Salvar">
    </p>
  </form>
</body>

</html>