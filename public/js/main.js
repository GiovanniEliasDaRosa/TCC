// #region Cookies
if (localStorage.getItem("accepted-cookies") == null) {
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
// #endregion

// #region Header
const header = document.querySelector("#header");
const main = document.querySelector("main");
const header__options = document.querySelector("#header__options");
const header__options__openmenu = document.querySelector("#header__options__openmenu");
const header__popupmenu = document.querySelector("#header__popupmenu");
const header__popupmenu__closemenu = document.querySelector("#header__popupmenu__closemenu");
let size = 24;
let headerMenuTimeout = "";
let headerH1Timeout = "";
let headerMenuShown = false;
let fontSize = parseFloat(window.getComputedStyle(document.documentElement).fontSize);

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
  let screenWidth = window.innerWidth;

  if (screenWidth > size * fontSize) {
    disable(header__options__openmenu);
    for (let i = 0; i < buttons.length; i++) {
      enable(buttons[i]);
    }
    document.body.style.overflow = "";

    disable(header__popupmenu);
    enable(main);
    headerMenuShown = true;
    return;
  }
  headerMenuShown = false;

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
const error__img = document.querySelector("#error__img");

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
  let type = "light";
  if (darkTheme) {
    type = "dark";
    changetheme__button.forEach((changeThemeButton) => {
      changeThemeButton.classList.remove("moon");
    });
  } else {
    changetheme__button.forEach((changeThemeButton) => {
      changeThemeButton.classList.add("moon");
    });
  }

  root.setAttribute("data-theme", type);

  if (error__img != null) {
    error__img.src = `/img/404error-${type}.png`;
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
window.ondblclick = () => {
  localStorage.clear();
  window.location.reload(true);
};

// #region Tab Swipe
let currentX = 0;
let startTouchX = 0;
let thresh = window.innerWidth / 14;
let canDragPage = false;
let invalidTouch = false;

main.classList.add("icons");
main.classList.add("outline");

let currentPage = null;
let pathname = window.location.pathname;
if (pathname == "/") {
  currentPage = "cronogram";
} else if (pathname == "/avisos") {
  currentPage = "warnings";
}

setTimeout(() => {
  canDragPage = true;
}, 1000);

window.ontouchstart = (e) => {
  startTouchX = e.changedTouches[0].clientX;
  currentX = 0;
  canDragPage = true;
  invalidTouch = false;

  if (inValidTouch(e)) {
    stopDrag();
    e.preventDefault();
    e.stopImmediatePropagation();
    return;
  }

  document.body.style.width = "100vw";
  document.body.style.overflow = "hidden";
};

window.ontouchmove = (e) => {
  currentX = e.changedTouches[0].clientX;

  if (inValidTouch(e)) {
    stopDrag();
    return;
  }

  if (currentPage == "cronogram" && currentX < startTouchX) {
    main.classList.add("pullAction");
    main.classList.add("warnings");
    main.classList.add("after");
  } else if (currentPage == "warnings" && currentX > startTouchX) {
    main.classList.add("pullAction");
    main.classList.add("cronogram");
    main.classList.remove("after");
  } else {
    stopDrag();
    return;
  }

  let percent = (currentX - startTouchX) / thresh;
  main.style.transform = `translateX(${percent}%)`;
  main.style.transition = `none`;
};

window.ontouchcancel = (e) => {
  ontouchend(e);
};

window.ontouchend = (e) => {
  stopDrag();

  if (inValidTouch(e)) return;

  currentX = e.changedTouches[0].clientX;

  if (currentPage == "cronogram") {
    if (currentX < startTouchX) {
      if (Math.abs(startTouchX - currentX) > thresh) {
        header__options.children[1].click();
      }
    }
  }
  if (currentPage == "warnings") {
    if (currentX > startTouchX) {
      if (Math.abs(startTouchX - currentX) > thresh) {
        header__options.children[0].click();
      }
    }
  }

  startTouchX = 0;
  currentX = 0;
};

function inValidTouch(e) {
  let eChangedTouchTarget = e.changedTouches[0].target;
  return (
    !canDragPage ||
    (currentPage != "cronogram" && currentPage != "warnings") ||
    window.innerWidth > 40 * fontSize ||
    invalidTouch ||
    eChangedTouchTarget.closest("#popUpAviso") != null ||
    eChangedTouchTarget.closest("#cookie__banner") != null ||
    eChangedTouchTarget.closest("#header") != null
  );
}

function stopDrag() {
  main.classList.remove("pullAction");
  main.classList.remove("cronogram");
  main.classList.remove("warnings");

  document.body.style.width = "";
  document.body.style.overflow = "";

  main.style.transform = `translateX(0%))`;
  main.style.transition = `0.2s transform`;
}
// #endregion

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
