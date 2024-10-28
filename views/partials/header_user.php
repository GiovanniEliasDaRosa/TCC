<header id="header">
  <a class="notButton" href="/">
    <img src="/img/headerlogo.png" alt="Logo escola" id="header__options__img">
  </a>

  <div id="header__options">
    <a class="header__options__button normal__nav <?= headerCronogram($headerSelected) ?>" href="/" style="display: none;" aria-disabled="true" disabled="true">Horários</a>
    <a class="header__options__button normal__nav <?= empty($headerSelected) ? 'active' : '' ?>" href="/avisos" id="header__options__warnings" style="display: none;" aria-disabled="true" disabled="true">Avisos</a>
    <button class="changetheme__button header__options__button normal__nav icons square big nomargin sun" title="Mudar tema" style="display: none;" aria-disabled="true" disabled="true"></button>

    <button class="header__options__button icons square big nomargin bars" id="header__options__openmenu" title="Abrir menu" style="display: none;" aria-disabled="true" disabled="true"></button>

    <nav id="header__popupmenu" style="display: none;" aria-disabled="true" disabled="true">
      <button class="header__options__button icons square big nomargin xmark" id="header__popupmenu__closemenu" title="Fechar menu"></button>
      <a class="header__options__button <?= headerCronogram($headerSelected, 'header__popupmenu__active') ?>" href="/">Horários</a>
      <a class="header__options__button <?= empty($headerSelected) ? 'header__popupmenu__active' : '' ?>" href="/avisos" id="header__popupmenu__warnings">Avisos</a>

      <button class="changetheme__button header__options__button normal__nav fullwidth icons nomargin sun" title="Mudar tema"></button>
    </nav>
  </div>
</header>