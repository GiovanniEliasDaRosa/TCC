const nome = document.getElementById("name");
const nomevazio = document.getElementById("nome_vazio");
const senha = document.getElementById("password");
const senhavazia = document.getElementById("senha_vazia");
const form = document.getElementById("enviar");

form.addEventListener("submit", (e) => {
  disable(nomevazio);
  disable(senhavazia);
  if (nome.value == "") {
    e.preventDefault();
    enable(nomevazio);
  }
  if (senha.value == "") {
    e.preventDefault();
    enable(senhavazia);
  }
});

function enable(element) {
  element.style.display = "";
  element.removeAttribute("aria-disabled");
}

function disable(element) {
  element.style.display = "none";
  element.setAttribute("aria-disabled", "true");
}
