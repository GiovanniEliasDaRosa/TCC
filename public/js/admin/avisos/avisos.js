const titulo = document.getElementById("titulo");
const tituloMensagem = document.getElementById("tituloMensagem");

const data1 = document.getElementById("data1");
const data1Mensagem = document.getElementById("data1Mensagem");

const data2 = document.getElementById("data2");
const data2Mensagem = document.getElementById("data2Mensagem");

const deletarAvisoBotao = document.getElementById("deletaraviso__botao");
const deletar = document.getElementById("deletar");

const form = document.getElementById("form");

form.addEventListener("submit", (e) => {
  disable(tituloMensagem);
  disable(data1Mensagem);
  disable(data2Mensagem);
  if (titulo.value.trim() == "") {
    e.preventDefault();
    tituloMensagem.innerText = "Adicione um título";
    enable(tituloMensagem);
  }

  if (titulo.value.lenght > 40) {
    e.preventDefault();
    tituloMensagem.innerText = "Um título com mais de 40 caracteres não é necessário";
    enable(tituloMensagem);
  }

  if (data1.value == "") {
    e.preventDefault();
    enable(data1Mensagem);
  }

  if (data2.value == "") {
    e.preventDefault();
    enable(data2Mensagem);
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

if (deletarAvisoBotao != null) {
  deletarAvisoBotao.onclick = () => {
    if (confirm("Deseja excluir esse aviso?")) {
      deletar.submit();
    }
  };
}
