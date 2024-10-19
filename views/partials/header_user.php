<header>
  <div class="logo__header">
    <img src="/img/headerlogo.png" alt="Logo escola" />
  </div>
  <div id="navegacao__header">
    <a class="navegacao__header__button normal__nav <?= headerCronogram($headerSelected) ?>" href="/">Horários</a>
    <a class="navegacao__header__button normal__nav <?= empty($headerSelected) ? 'active' : '' ?>" href="/avisos" id="navegacao__header__avisos">Avisos</a>

    <button class="navegacao__header__button icons square nomargin bars" id="navegacao__header__openmenu" title="Abrir menu"></button>

    <nav id="navegacao__menu" style="display: none;" aria-disabled="true" disabled="true">
      <button class="navegacao__header__button icons square nomargin xmark" id="navegacao__header__closemenu" title="Fechar menu"></button>
      <a class="navegacao__header__button" href="/">Horários</a>
      <a class="navegacao__header__button" href="/avisos" id="navegacao__menu__avisos">Avisos</a>
    </nav>
  </div>
</header>