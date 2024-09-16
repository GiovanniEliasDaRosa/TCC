const accordions = document.querySelectorAll(".accordion");

accordions.forEach((accordion) => {
  accordion.addEventListener("click", () => {
    console.log(accordion);
    console.log(accordion.querySelector(".accordion-body"));
    const body = accordion.querySelector(".accordion-body");
    body.classList.toggle("active");
  });
});
