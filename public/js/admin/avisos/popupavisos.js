const popup__saved = document.querySelector("#popup__saved");
const popup__button = document.querySelector("#popup__button");

if (popup__button != null) {
  popup__button.onclick = () => {
    popup__saved.setAttribute("data-hide", "true");
  };
}
