<header>
  <div class="logo__header">
    <img src="/img/header-logo.png" alt="logo" />
  </div>
  <h1>Tela administrativa</h1>
  <div class="navegacao__header">
    <a class="navegacao__header__button <?= !empty($headerSelected) ? 'active' : '' ?>" href="/admin">Horários</a>
    <a class="navegacao__header__button <?= empty($headerSelected) ? 'active' : '' ?>" href=" /admin/avisos">Avisos</a>

    <form method="post" action="/logout" enctype="multipart/form-data">
      <button type="submit" class="botao" id="deslog">Sair</button>
    </form>
  </div>
</header>