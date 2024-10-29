// #region Cookies
if (localStorage.getItem("accepted-cookies") == null) {
  document.body.innerHTML += `<div id="cookie__banner">
    <div id="cookie__banner__description">
      <img src="/img/cookies.png" alt="Imagem de cookies" id="cookie__banner__img" data-loading="true"/>
      <p>Este site utiliza cookies para melhorar sua experiência. Ao continuar navegando, você concorda com o uso de cookies. <a href="/politica-de-cookies" class="link">Saiba mais</a>.</p>
    </div>
    <button id="accept__cookies">Aceitar</button>
  </div>`;

  const cookie__banner = document.querySelector("#cookie__banner");
  const accept__cookies = document.querySelector("#accept__cookies");
  const cookie__banner__img = document.querySelector("#cookie__banner__img");

  accept__cookies.onclick = () => {
    localStorage.setItem("accepted-cookies", "true");
    cookie__banner.style.display = "none";
    cookie__banner.setAttribute("aria-disabled", "true");
    cookie__banner.setAttribute("disabled", "true");
  };

  cookie__banner__img.onload = () => {
    cookie__banner__img.removeAttribute("data-loading");
  };
}
// #endregion

// #region Header
const header = document.querySelector("#header");
const main = document.querySelector("main");
const header__options = document.querySelector("#header__options");
const header__options__openmenu = document.querySelector("#header__options__openmenu");
const header__popupmenu = document.querySelector("#header__popupmenu");
const header__popupmenu__closemenu = document.querySelector("#header__popupmenu__closemenu");
const header__options__img = document.querySelector("#header__options__img");
let size = 24;
let headerMenuTimeout = "";
let headerH1Timeout = "";

header__options__img.onload = () => {
  header__options__img.removeAttribute("data-loading");
};

if (header__options.dataset.admin == "true") {
  size = 47;
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
// #endregion

// #region Themes
const root = document.querySelector(":root");
const changetheme__button = Array.from(document.querySelectorAll(".changetheme__button"));

changetheme__button.forEach((changeThemeButton) => {
  changeThemeButton.onclick = () => {
    darkTheme = !darkTheme;
    saveTheme();
    updateTheme();
  };
});

let darkTheme = true;
loadTheme();

function loadTheme() {
  let rootTheme = root.getAttribute("data-theme");
  if (rootTheme == "light") {
    darkTheme = false;
  }

  // Try to get the saved theme from localStorage
  let savedTheme = localStorage.getItem("theme");

  // If there is no saved theme in localStorage, check the cookie
  if (savedTheme == null) {
    savedTheme = getCookie("theme");
  }

  // If prefers Light Theme
  if (savedTheme == null && window.matchMedia("(prefers-color-scheme: light)").matches) {
    darkTheme = false;
    saveTheme();
  }

  updateTheme();
}

function updateTheme() {
  if (darkTheme) {
    root.setAttribute("data-theme", "dark");

    changetheme__button.forEach((changeThemeButton) => {
      changeThemeButton.classList.remove("moon");
    });
  } else {
    root.setAttribute("data-theme", "light");

    changetheme__button.forEach((changeThemeButton) => {
      changeThemeButton.classList.add("moon");
    });
  }
}

function saveTheme() {
  let theme = darkTheme ? "dark" : "light";

  document.cookie = `theme=${theme}; SameSite=Strict; path=/;`;

  // Save the theme in localStorage
  localStorage.setItem("theme", theme);
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}
// #endregion

// Enable for testing on mobile, double tap to reset stylesheets
// window.ondblclick = (e) => {
//   localStorage.clear();
//   window.location.reload(true);
// };

// #region Functions
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
// #endregion
