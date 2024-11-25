<?php require(BASE_PATH . '/views/partials/head.php') ?>
<link rel="stylesheet" type="text/css" href="/css/user/whereweare.css" />

</head>

<body>
  <?php require(BASE_PATH . '/views/partials/header_user.php') ?>

  <main>
    <h1>Onde estamos</h1>
    <div id="side">
      <iframe
        id='maps'
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1110.8228524217143!2d-46.679869330365094!3d-22.68458556135368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c923579756b90d%3A0xe4e2bea27d41ea36!2sSecretaria%20de%20Estado%20da%20Educa%C3%A7%C3%A3o!5e1!3m2!1spt-BR!2sbr!4v1730926637220!5m2!1spt-BR!2sbr"
        width="400"
        height="300"
        style="border: 0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

      <div id="description">
        <h2 class="icons location-dot">Localização</h2>
        <p class="description__p">
          <span class="icons location-dot">Av. Viriato Valente, 538 - Monte Alegre do Sul, SP, 13820-000</span>
          <span class="icons phone">(19) 3899-1215</span>
        </p>

        <h2 class="icons headset">Suporte</h2>
        <p class="description__p">
          <span class="icons envelope">e017425a@educacao.sp.gov</span>
          <span class="icons phone">(19) 3899-1276</span>
          <span class="icons map-location-dot">CEP: 13820-000</span>
        </p>
      </div>
    </div>
  </main>

  <script>
    var iframe = document.querySelector("iframe");

    iframe.onload = () => {
      iframe.animate(
        [{
          opacity: 0
        }, {
          opacity: 1
        }], {
          duration: 1000,
        });
    };
  </script>

  <?php require(BASE_PATH . '/views/partials/footer.php') ?>