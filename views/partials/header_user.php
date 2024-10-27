<header id="header">
  <a class="notButton" href="/">
    <img src="/img/headerlogo.png" alt="Logo escola" id="header__options__img">
  </a>

  <div id="header__options">
    <a class="header__options__button normal__nav <?= headerCronogram($headerSelected) ?>" href="/">Horários</a>
    <a class="header__options__button normal__nav <?= empty($headerSelected) ? 'active' : '' ?>" href="/avisos" id="header__options__warnings">Avisos</a>

    <button class="header__options__button icons square nomargin bars" id="header__options__openmenu" title="Abrir menu" style="display: none;" aria-disabled="true" disabled="true"></button>

    <nav id="header__popupmenu" style="display: none;" aria-disabled="true" disabled="true">
      <button class="header__options__button icons square nomargin xmark" id="header__popupmenu__closemenu" title="Fechar menu"></button>
      <a class="header__options__button <?= headerCronogram($headerSelected, 'header__popupmenu__active') ?>" href="/">Horários</a>
      <a class="header__options__button <?= empty($headerSelected) ? 'header__popupmenu__active' : '' ?>" href="/avisos" id="header__popupmenu__warnings">Avisos</a>
    </nav>
  </div>
</header>