<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/admin/cronograma/style.css">
<link rel="stylesheet" type="text/css" href="/css/admin/popup.css">
<script src="/js/admin/cronograma/main.js" defer="true"></script>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_admin.php') ?>

  <?php if ($saved) : ?>
    <div id="popup__saved">
      Cronograma salvo com sucesso!
    </div>
  <?php endif; ?>

  <main>
    <form method="post" action="/admin/<?= $formPath ?>" enctype="multipart/form-data" id="upload__form">
      <?php if ($formPath != 'new') : ?>
        <input type="hidden" name="_method" value="PATCH">
      <?php endif; ?>

      <input type="file" name="upload__file" id="upload__file" style="display: none;">

      <p
        <?= isset($errors['error']) ? '' : 'style="display: none" aria-disabled="true" disabled="true"' ?>
        id="feedbackMessage" class="error icons warn">
        <?php if (isset($errors['error'])) : ?>
          <?= $errors['error'] ?>
        <?php endif; ?>
      </p>

      <button type="button" class="icons upload" for="upload__file" id="upload__button"><?= $text ?></button>
    </form>

    <?= $data ?>
  </main>
</body>

</html>