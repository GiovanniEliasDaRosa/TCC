<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cronograma Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/admin/cronograma/style.css">
</head>

<body>
  <header>
    <div class="logo__header">
      <img src="/img/logo.png" alt="logo" />
    </div>
    <h1>Tela administrativa</h1>
    <div class="navegacao__header">
      <a class="navegacao__header__button active" href="/admin">Horários</a>
      <a class="navegacao__header__button" href="/admin/avisos">Avisos</a>


      <form method="post" action="/logout" enctype="multipart/form-data">
        <button type="submit" class="botao" id="deslog">Sair</button>
      </form>
    </div>
  </header>

  <main>
    <div id="action">
      <?= $result['link'] ?>
    </div>

    <?= $result['data'] ?>
  </main>
</body>

</html>