<?php require(BASE_PATH . '/views/partials/head.php') ?>

<style>
  h2 {
    display: flex;
    gap: 0.5em;
    align-items: center;
  }

  #h2__image {
    width: 2em;
    height: 2em;
    object-fit: cover;
  }
</style>
</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>

  <main>
    <h2><img src="/img/cookies.png" alt="Imagem de cookies" id="h2__image" />Política de Cookies</h2>
    <p>Nosso site utiliza cookies para melhorar a experiência do usuário. Cookies são pequenos arquivos de texto armazenados no seu dispositivo. Utilizamos cookies para salvar suas preferências, como a sala selecionada no cronograma.</p>
    <p>Tipos de cookies que utilizamos:</p>
    <ul>
      <li><strong>Cookies Funcionais:</strong> Esses cookies são essenciais para o funcionamento do site e não podem ser desativados. Eles são usados para salvar suas preferências, como a sala selecionada no cronograma.</li>
      <li><strong>Cookies de Sessão:</strong> Utilizados na área administrativa do site para manter a segurança e a funcionalidade durante a sessão. Esses cookies expiram quando você fecha o navegador.</li>
    </ul>
  </main>

  <?php require(BASE_PATH . '/views/partials/footer.php') ?>