const popUpAviso = document.querySelector("#popUpAviso");
const popUpAviso__div = document.querySelector("#popUpAviso__div");
const popUpAviso__header__title = popUpAviso.querySelector("#popUpAviso__header__title");
const popUpAviso__content = popUpAviso.querySelector("#popUpAviso__content");

const popUpAviso__header__close = document.querySelector("#popUpAviso__header__close");
const popUpAviso__header__opens = document.querySelectorAll(".popUpAviso__header__open");
let popupOpen = false;
let animatingPopUp = false;
let animatePopUp = "";

popUpAviso__header__opens.forEach((item) => {
  item.onclick = () => {
    if (animatingPopUp) return;

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

    popUpAviso.classList.add("open");
    popUpAviso__div.classList.add("open");

    popUpAviso.classList.remove("close");
    popUpAviso__div.classList.remove("close");
    animatingPopUp = true;

    animatePopUp = setTimeout(() => {
      popUpAviso.classList.remove("open");
      popUpAviso__div.classList.remove("open");
      animatingPopUp = false;
    }, 1000);
  };
});

popUpAviso__header__close.onclick = () => {
  if (animatingPopUp) return;

  popupOpen = false;

  clearTimeout(animatePopUp);

  popUpAviso.classList.remove("open");
  popUpAviso__div.classList.remove("open");

  popUpAviso.classList.add("close");
  popUpAviso__div.classList.add("close");

  popUpAviso.classList.remove("open");
  popUpAviso__div.classList.remove("open");
  animatingPopUp = true;

  animatePopUp = setTimeout(() => {
    popUpAviso.classList.remove("close");
    popUpAviso__div.classList.remove("close");
    animatingPopUp = false;
    disable(popUpAviso);
  }, 1000);
};

const avisos = document.querySelector("#avisos");
const navegacao__header__avisos = document.querySelector("#navegacao__header__avisos");
let lastWarningSaw = localStorage.getItem("lastWarningSaw");

if (lastWarningSaw == null) {
  lastWarningSaw = 0;
}

if (avisos.children.length == 0) {
  console.log("removeItem");
  localStorage.removeItem("lastWarningSaw");
} else {
  console.log("setItem");
  let childs = Array.from(avisos.children);
  let addedTime = 0;
  let lastId = 0;
  childs.forEach((child) => {
    let childId = child.dataset.id;
    if (childId > lastId) {
      lastId = childId;
    }

    if (childId > lastWarningSaw) {
      child.classList.add("willNewWarn");
      setTimeout(() => {
        child.classList.add("newWarn");
        child.classList.remove("willNewWarn");
      }, 100 * addedTime);
      addedTime++;
    }
  });
  localStorage.setItem("lastWarningSaw", lastId);
}
