<?php require(BASE_PATH . '/views/partials/head.php') ?>
<title>Cronograma Admin</title>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/admin/cronograma/style.css">
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_admin.php') ?>

  <main>
    <div id="action">
      <?= $result['link'] ?>
    </div>

    <?= $result['data'] ?>
  </main>
</body>

</html>