const nome = document.getElementById('name')
const nomevazio = document.getElementById('nome_vazio')
const senha = document.getElementById('password')
const senhavazia = document.getElementById('senha_vazia')
const formu = document.getElementById('enviar')

formu.addEventListener('submit', (e) => {
    nomevazio.style.display = "none"
    senhavazia.style.display = "none"
    if(nome.value == ""){
        e.preventDefault()
        nomevazio.style.display = ""
    } 
    if(senha.value == ""){
        e.preventDefault()
        senhavazia.style.display = ""
   }
  
})

