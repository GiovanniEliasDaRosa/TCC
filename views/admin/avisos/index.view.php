<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avisos Admin</title>
</head>

<body>
  <form method="post" action="/logout" enctype="multipart/form-data">
    <button type="submit">Log out</button>
  </form>

  <?php foreach ($avisos as $aviso) : ?>
    <div>
      <span><?= $aviso['titulo'] ?></span>
      <span><?= htmlspecialchars($aviso['corpo']) ?></span>
      <span><?= $aviso['dt_inicio'] ?></span>
      <span><?= $aviso['dt_fim'] ?></span>
      <a href="/admin/avisos/edit?id=<?= $aviso['id_aviso'] ?>">Editar</a>
    </div>
  <?php endforeach; ?>

  <a href='/admin/avisos/new'>Adicionar aviso</a>
</body>

</html>