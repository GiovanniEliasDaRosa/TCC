<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/user/style.css" />
  <link rel="stylesheet" type="text/css" href="css/user/avisos.css" />
</head>

<body>
  <div class="header">
    <div class="logo_header">
      <img src="img/logo.png" alt="logo" />
    </div>
    <div class="navegacao_header">
      <a href="index.html">Horários</a>
      <a href="avisos.html" class="active">Avisos</a>
    </div>
  </div>

  <?php foreach ($avisos as $aviso) : ?>
    <div>
      <span><?= $aviso['titulo'] ?></span>
      <span><?= htmlspecialchars($aviso['corpo']) ?></span>
      <span><?= $aviso['dt_inicio'] ?></span>
      <span><?= $aviso['dt_fim'] ?></span>
      <button>Ler Mais</button>
    </div>
  <?php endforeach; ?>
</body>

</html>

<!-- # Allow access to files in the public directory

RewriteCond %{REQUEST_URI} ^/css/ [OR]
RewriteCond %{REQUEST_URI} ^/js/ [OR]
RewriteCond %{REQUEST_URI} ^/img/
RewriteRule ^ - [L]

# Route all other requests to index.php -->