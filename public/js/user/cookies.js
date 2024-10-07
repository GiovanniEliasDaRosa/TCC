if (localStorage.getItem("accepted-cookies") == null) {
  // style="display: none;" aria-disabled="true" disabled="true"
  document.body.innerHTML += `<div id="cookie__banner">
    <div id="cookie__banner__description">
      <img src="/img/cookies.png" alt="Imagem de cookies" id="cookie__banner__img"/>
      <p>Este site utiliza cookies para melhorar sua experiência. Ao continuar navegando, você concorda com o uso de cookies. <a href="/politica-de-cookies" class="link">Saiba mais</a>.</p>
    </div>
    <button id="accept__cookies">Aceitar</button>
  </div>`;

  const cookie__banner = document.querySelector("#cookie__banner");
  const accept__cookies = document.querySelector("#accept__cookies");

  accept__cookies.onclick = () => {
    localStorage.setItem("accepted-cookies", "true");
    cookie__banner.style.display = "none";
    cookie__banner.setAttribute("aria-disabled", "true");
    cookie__banner.setAttribute("disabled", "true");
  };
}
