const accordions = document.querySelectorAll(".accordion");
const form = document.querySelector("#form");
const selectedClass = document.querySelector("#selectedClass");
const active = document.querySelector(".accordion[data-active='true']");

setTimeout(() => {
  active.click();
}, 100);

accordions.forEach((accordion) => {
  accordion.addEventListener("click", () => {
    console.log(accordion);
    console.log(accordion.querySelector(".accordion-body"));
    const body = accordion.querySelector(".accordion-body");
    body.classList.toggle("active");
  });
});

selectedClass.onchange = (e) => {
  form.submit();
};

const lastWarning = document.querySelector("#lastWarning");
const lastWarningSaw = localStorage.getItem("lastWarningSaw");

if (lastWarning.textContent != lastWarningSaw && lastWarning.textContent != "none") {
  // The next if check if the last warning is greater than the one the user last saw
  // If the administrator deleted one warning and the user saw we don't continue for visual
  if (lastWarning.textContent > lastWarningSaw) {
    document.querySelector("#navegacao__header__avisos").setAttribute("data-warning", "true");
    document.querySelector("#navegacao__menu__avisos").setAttribute("data-warning", "true");
    document.querySelector("#navegacao__header__openmenu").setAttribute("data-warning", "true");
  }
}
