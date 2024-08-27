<form action="/session" method="POST">
  <label for="name">Nome</label>
  <input id="name" name="name" type="name" autocomplete="name" data-required>
  <br>

  <?php if (isset($errors['name'])) : ?>
    <p><?= $errors['name'] ?></p>
  <?php endif; ?>

  <label for="password">Password</label>
  <input id="password" name="password" type="password" autocomplete="current-password" data-required>
  <br>

  <?php if (isset($errors['password'])) : ?>
    <p><?= $errors['password'] ?></p>
  <?php endif; ?>

  <?php if (isset($errors['general'])) : ?>
    <p><?= $errors['general'] ?></p>
  <?php endif; ?>

  <button type="submit">Log In</button>
</form>