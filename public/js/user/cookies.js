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

const header = document.querySelector("header");
const main = document.querySelector("main");
const navegacao__header = document.querySelector("#navegacao__header");
const navegacao__header__openmenu = document.querySelector("#navegacao__header__openmenu");
const navegacao__menu = document.querySelector("#navegacao__menu");
const navegacao__header__closemenu = document.querySelector("#navegacao__header__closemenu");
let size = 25;
let headerMenuTimeout = "";

if (navegacao__header.dataset.admin == "true") {
  size = 42;
}

navegacao__header__openmenu.onclick = () => {
  clearTimeout(headerMenuTimeout);

  enable(navegacao__menu);
  document.body.style.overflow = "hidden";
  navegacao__header__closemenu.focus();

  navegacao__menu.setAttribute("data-open", "true");
  navegacao__menu.removeAttribute("data-close");
  headerMenuTimeout = setTimeout(() => {
    navegacao__menu.removeAttribute("data-open");
    disable(navegacao__header__openmenu);
    disable(main);
  }, 750);
};

navegacao__header__closemenu.onclick = () => {
  clearTimeout(headerMenuTimeout);

  document.body.style.overflow = "";
  navegacao__header__openmenu.focus();

  enable(navegacao__header__openmenu);
  enable(main);

  navegacao__menu.setAttribute("data-close", "true");
  navegacao__menu.removeAttribute("data-open");
  headerMenuTimeout = setTimeout(() => {
    navegacao__menu.removeAttribute("data-close");
    disable(navegacao__menu);
  }, 750);
};

let headerH1Timeout = "";

function checkHeader() {
  let buttons = Array.from(navegacao__header.children).filter((child) =>
    child.classList.contains("normal__nav")
  );

  clearTimeout(headerH1Timeout);
  let responsive = parseFloat(window.getComputedStyle(document.documentElement).fontSize);
  let screenWidth = window.innerWidth;

  if (screenWidth > size * responsive) {
    disable(navegacao__header__openmenu);
    for (let i = 0; i < buttons.length; i++) {
      enable(buttons[i]);
    }
    document.body.style.overflow = "";

    disable(navegacao__menu);
    enable(main);
    return;
  }

  for (let i = 0; i < buttons.length; i++) {
    disable(buttons[i]);
  }
  enable(navegacao__header__openmenu);

  // Get root element styles, and get font size

  // Header admin
  if (navegacao__header.dataset.admin == "true") {
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

function enable(element) {
  element.removeAttribute("aria-disabled");
  element.removeAttribute("disabled");
  navegacao__header__openmenu.disabled = false;
  element.style.display = "";
}

function disable(element) {
  element.setAttribute("aria-disabled", "true");
  element.setAttribute("disabled", "true");
  element.style.display = "none";
}

window.ondblclick = (e) => {
  window.location.reload(true);
};

window.onresize = () => {
  checkHeader();
};

checkHeader();
