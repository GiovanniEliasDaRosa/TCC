const accordions = document.querySelectorAll(".accordion");
const form = document.querySelector("#form");
const selectedClass = document.querySelector("#selectedClass");

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
