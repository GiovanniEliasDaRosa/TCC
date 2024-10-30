<header id="header" class="hasBG">
  <a class="notButton" href="/admin/">
    <img src="/img/headerlogo.png" alt="Logo da escola" id="header__options__img" data-loading="true">
  </a>

  <h1>Tela administrativa</h1>

  <div id="header__options" data-admin="true">
    <a class="header__options__button normal__nav <?= headerCronogram($headerSelected) ?>" href="/admin">Horários</a>
    <a class="header__options__button normal__nav <?= empty($headerSelected) ? 'active' : '' ?>" href="/admin/avisos" id="header__options__warnings">Avisos</a>
    <button class="changetheme__button header__options__button normal__nav icons square big nomargin sun" title="Mudar tema"></button>
    <form class="normal__nav" method="post" action="/logout" enctype="multipart/form-data">
      <button type="submit" class="icons square big nomargin exit"></button>
    </form>

    <button class="header__options__button icons square big nomargin bars" id="header__options__openmenu" title="Abrir menu"></button>

    <nav id="header__popupmenu" style="display: none;" aria-disabled="true" disabled="true">
      <button class="header__options__button icons square big nomargin xmark" id="header__popupmenu__closemenu" title="Fechar menu"></button>
      <a class="header__options__button <?= headerCronogram($headerSelected, 'header__popupmenu__active') ?>" href="/admin">Horários</a>
      <a class="header__options__button <?= empty($headerSelected) ? 'header__popupmenu__active' : '' ?>" href="/admin/avisos" id="header__popupmenu__warnings">Avisos</a>

      <div id="header__popupmenu__options">
        <form method="post" action="/logout" enctype="multipart/form-data">
          <button type="submit" class="header__popupmenu__options__button icons exit">Sair</button>
        </form>
        <button class="changetheme__button header__options__button header__popupmenu__options__button  normal__nav icons nomargin sun" title="Mudar tema"></button>
      </div>
    </nav>
  </div>
</header>