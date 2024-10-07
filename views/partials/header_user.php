<header>
  <div class="logo__header">
    <img src="/img/headerlogo.png" alt="Logo escola" />
  </div>
  <div class="navegacao__header">
    <a class="navegacao__header__button <?= headerCronogram($headerSelected) ?>" href="/">Horários</a>
    <a class="navegacao__header__button <?= empty($headerSelected) ? 'active' : '' ?>" href="/avisos" id="navegacao__header__avisos">Avisos</a>
  </div>
</header>