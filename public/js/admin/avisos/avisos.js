const titulo = document.getElementById("titulo");
const titulo__mensagem = document.getElementById("titulo__mensagem");

const dt_inicio = document.getElementById("dt_inicio");
const dt_inicio__mensagem = document.getElementById("dt_inicio__mensagem");

const dt_fim = document.getElementById("dt_fim");
const dt_fim__mensagem = document.getElementById("dt_fim__mensagem");

const deletarAvisoBotao = document.getElementById("deletaraviso__botao");
const deletar = document.getElementById("deletar");

const form = document.getElementById("form");

form.addEventListener("submit", (e) => {
  disable(titulo__mensagem);
  disable(dt_inicio__mensagem);
  disable(dt_fim__mensagem);
  if (titulo.value.trim() == "") {
    e.preventDefault();
    titulo__mensagem.innerText = "Adicione um título";
    enable(titulo__mensagem);
  }

  if (titulo.value.length > 40) {
    e.preventDefault();
    titulo__mensagem.innerText = "Um título com mais de 40 caracteres não é necessário";
    enable(titulo__mensagem);
  }

  if (dt_inicio.value == "") {
    e.preventDefault();
    dt_inicio__mensagem.innerText = "Adicione a data de postagem";
    enable(dt_inicio__mensagem);
  }

  if (dt_fim.value == "") {
    e.preventDefault();
    dt_fim__mensagem.innerText = "Adicione a data de expiração";
    enable(dt_fim__mensagem);
  }

  // if (dt_inicio.value == "" || dt_fim.value == "") {
  //   return;
  // }

  // Converte a string para um objeto Date em UTC
  let postagem = new Date(dt_inicio.value + "T00:00:00").setHours(0, 0, 0, 0);
  let expiracao = new Date(dt_fim.value + "T00:00:00").setHours(0, 0, 0, 0);
  let agora = new Date().setHours(0, 0, 0, 0);

  console.table([postagem, expiracao, agora]);

  if (expiracao < postagem) {
    e.preventDefault();
    dt_fim__mensagem.innerText =
      "A data de expiração deve ser após a data de postagem. Selecione uma data válida";
    enable(dt_fim__mensagem);
  }

  if (postagem < agora) {
    e.preventDefault();
    dt_inicio__mensagem.innerText =
      "A data de postagem não pode ser no passado. Selecione uma data de hoje ou futura";
    enable(dt_inicio__mensagem);
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
