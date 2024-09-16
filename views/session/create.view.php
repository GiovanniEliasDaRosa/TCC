<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Log in</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/admin/login/login.css">
  <script src='/js/admin/login/login.js' defer></script>
</head>

<body>
  <main>
    <form action="/login" method="POST" id="enviar">
      <h1>Login</h1>

      <div class="form__section">
        <label for="name">Nome</label>
        <input type="text" id="name" name="name" autocomplete="name" value="<?= old('name') ?>" placeholder="Nome">
        <p id="nome_vazio" class="erros" style="display: none;">Por favor informe um nome válido</p>
      </div>

      <div class="form__section">
        <label for="password">Senha</label>
        <input
          type="password"
          id="password"
          name="password"
          autocomplete="current-password"
          placeholder="Senha" />
        <p id="senha_vazia" class="erros" style="display: none;">Por favor informe uma senha válida</p>
      </div>

      <?php if (isset($errors['general'])) : ?>
        <p class="erros"><?= $errors['general'] ?></p>
      <?php endif; ?>

      <button type="submit">Entrar</button>
    </form>
  </main>
</body>

</html>