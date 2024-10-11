const popUpAviso = document.querySelector("#popUpAviso");
const popUpAviso__header__title = popUpAviso.querySelector("#popUpAviso__header__title");
const popUpAviso__content = popUpAviso.querySelector("#popUpAviso__content");

const popUpAviso__header__close = document.querySelector("#popUpAviso__header__close");
const popUpAviso__header__opens = document.querySelectorAll(".popUpAviso__header__open");
let popupOpen = false;

popUpAviso__header__opens.forEach((item) => {
  item.onclick = () => {
    let aviso = item.parentElement;
    let dateStart = aviso.querySelector(".aviso__date__start");
    let title = aviso.querySelector(".aviso__title");
    let dateEnd = aviso.querySelector(".aviso__date__end");
    let content = aviso.querySelector(".aviso__content");

    popUpAviso__header__title.innerText = title.innerText;
    popUpAviso__content.innerText = content.innerText;
    popUpAviso__date__start.innerText = dateStart.innerText;
    popUpAviso__date__end.innerText = dateEnd.innerText;

    popUpAviso.style.display = "";
    popUpAviso.removeAttribute("aria-disabled");
    popupOpen = true;
  };
});

popUpAviso__header__close.onclick = () => {
  popUpAviso.style.display = "none";
  popUpAviso.setAttribute("aria-disabled", "true");
  popupOpen = false;
};

const avisos = document.querySelector("#avisos");
const navegacao__header__avisos = document.querySelector("#navegacao__header__avisos");

if (avisos.children.length == 0) {
  localStorage.removeItem("lastWarningSaw");
} else {
  localStorage.setItem("lastWarningSaw", avisos.children[0].dataset.id);
}
