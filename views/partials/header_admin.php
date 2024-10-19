<header>
  <div class="logo__header">
    <img src="/img/headerlogo.png" alt="Logo escola" />
  </div>
  <h1>Tela administrativa</h1>
  <div id="navegacao__header" data-admin="true">
    <a class="navegacao__header__button normal__nav <?= headerCronogram($headerSelected) ?>" href="/admin/">Horários</a>
    <a class="navegacao__header__button normal__nav <?= empty($headerSelected) ? 'active' : '' ?>" href="/admin/avisos" id="navegacao__header__avisos">Avisos</a>
    <form class="normal__nav" method="post" action="/logout" enctype="multipart/form-data">
      <button type="submit" class="icons nomargin exit" id="deslog"></button>
    </form>

    <button class="navegacao__header__button icons square nomargin bars" id="navegacao__header__openmenu" title="Abrir menu"></button>

    <nav id="navegacao__menu" style="display: none;" aria-disabled="true" disabled="true">
      <div id="admin">
        <button class="navegacao__header__button icons square nomargin xmark" id="navegacao__header__closemenu" title="Fechar menu"></button>
        <h1>Tela administrativa</h1>
      </div>
      <a class="navegacao__header__button" href="/admin">Horários</a>
      <a class="navegacao__header__button" href="/admin/avisos" id="navegacao__header__avisos">Avisos</a>
      <form method="post" action="/logout" enctype="multipart/form-data">
        <button type="submit" class="icons exit" id="deslog">Sair</button>
      </form>
    </nav>
  </div>
</header>