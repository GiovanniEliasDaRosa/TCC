const popUpAviso = document.querySelector("#popUpAviso");
const popUpAviso__div = document.querySelector("#popUpAviso__div");
const popUpAviso__header__title = popUpAviso.querySelector("#popUpAviso__header__title");
const popUpAviso__content = popUpAviso.querySelector("#popUpAviso__content");

const popUpAviso__header__close = document.querySelector("#popUpAviso__header__close");
const popUpAviso__header__opens = document.querySelectorAll(".popUpAviso__header__open");
let popupOpen = false;
let animatePopUp = "";

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

    enable(popUpAviso);
    popupOpen = true;
    clearTimeout(animatePopUp);

    popUpAviso.classList.remove("close");
    popUpAviso__div.classList.remove("close");

    popUpAviso.classList.add("open");
    popUpAviso__div.classList.add("open");

    animatePopUp = setTimeout(() => {
      popUpAviso.classList.remove("open");
      popUpAviso__div.classList.remove("open");
    }, 1000);
  };
});

popUpAviso__header__close.onclick = () => {
  popupOpen = false;

  clearTimeout(animatePopUp);

  popUpAviso.classList.remove("open");
  popUpAviso__div.classList.remove("open");

  popUpAviso.classList.add("close");
  popUpAviso__div.classList.add("close");

  animatePopUp = setTimeout(() => {
    popUpAviso.classList.remove("close");
    popUpAviso__div.classList.remove("close");

    disable(popUpAviso);
  }, 1000);
};

const avisos = document.querySelector("#avisos");
const navegacao__header__avisos = document.querySelector("#navegacao__header__avisos");

if (avisos.children.length == 0) {
  localStorage.removeItem("lastWarningSaw");
} else {
  localStorage.setItem("lastWarningSaw", avisos.children[0].dataset.id);
}
