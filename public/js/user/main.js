// cookies
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

// header
const header = document.querySelector("#header");
const main = document.querySelector("main");
const header__options = document.querySelector("#header__options");
const header__options__openmenu = document.querySelector("#header__options__openmenu");
const header__popupmenu = document.querySelector("#header__popupmenu");
const header__popupmenu__closemenu = document.querySelector("#header__popupmenu__closemenu");
let size = 25;
let headerMenuTimeout = "";
let headerH1Timeout = "";

if (header__options.dataset.admin == "true") {
  size = 42;
}

header__options__openmenu.onclick = () => {
  clearTimeout(headerMenuTimeout);

  enable(header__popupmenu);
  document.body.style.overflow = "hidden";
  header__popupmenu__closemenu.focus();

  header__popupmenu.setAttribute("data-open", "true");
  header__popupmenu.removeAttribute("data-close");
  headerMenuTimeout = setTimeout(() => {
    header__popupmenu.removeAttribute("data-open");
    disable(header__options__openmenu);
    disable(main);
  }, 750);
};

header__popupmenu__closemenu.onclick = () => {
  clearTimeout(headerMenuTimeout);

  document.body.style.overflow = "";
  header__options__openmenu.focus();

  enable(header__options__openmenu);
  enable(main);

  header__popupmenu.setAttribute("data-close", "true");
  header__popupmenu.removeAttribute("data-open");
  headerMenuTimeout = setTimeout(() => {
    header__popupmenu.removeAttribute("data-close");
    disable(header__popupmenu);
  }, 750);
};

function checkHeader() {
  let buttons = Array.from(header__options.children).filter((child) =>
    child.classList.contains("normal__nav")
  );

  clearTimeout(headerH1Timeout);
  let responsive = parseFloat(window.getComputedStyle(document.documentElement).fontSize);
  let screenWidth = window.innerWidth;

  if (screenWidth > size * responsive) {
    disable(header__options__openmenu);
    for (let i = 0; i < buttons.length; i++) {
      enable(buttons[i]);
    }
    document.body.style.overflow = "";

    disable(header__popupmenu);
    enable(main);
    return;
  }

  for (let i = 0; i < buttons.length; i++) {
    disable(buttons[i]);
  }
  enable(header__options__openmenu);
  header__options__openmenu.disabled = false;

  // Get root element styles, and get font size

  // Header admin
  if (header__options.dataset.admin == "true") {
    // header can't fit, and will overflow
    if (header.getBoundingClientRect().width > screenWidth) {
      disable(header.querySelector("h1"));
      header.setAttribute("data-hidden-h1", "true");
    } else {
      headerH1Timeout = setTimeout(() => {
        enable(header.querySelector("h1"));
        if (header.getBoundingClientRect().width > screenWidth) {
          disable(header.querySelector("h1"));
        } else {
          header.removeAttribute("data-hidden-h1");
        }
      }, 400);
    }
  }
}

window.onresize = () => {
  checkHeader();
};

checkHeader();

// Enable for testing on mobile, double tap to reset stylesheets
window.ondblclick = (e) => {
  window.location.reload(true);
};

// functions
function enable(element) {
  element.removeAttribute("aria-disabled");
  element.removeAttribute("disabled");
  element.style.display = "";
}

function disable(element) {
  element.setAttribute("aria-disabled", "true");
  element.setAttribute("disabled", "true");
  element.style.display = "none";
}
