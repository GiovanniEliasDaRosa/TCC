const titulo = document.getElementById('titulo')
const tituloMensagem = document.getElementById('tituloMensagem')
const data1 = document.getElementById('data1')
const data2 = document.getElementById('data2')
const formu = document.getElementById('formu')
const excluirdiv = document.getElementById('excluir')
const cancel = document.getElementById('cancel')

formu.addEventListener('submit', (e) => {
    tituloMensagem.style.display = "none"
    data1Mensagem.style.display = "none"
    data2Mensagem.style.display = "none"
    if(titulo.value == ""){
        e.preventDefault()
        tituloMensagem.style.display = ""
    } 
    if(data1.value == ""){
        e.preventDefault()
        data1Mensagem.style.display = ""
   }
    if(data2.value == ""){
        e.preventDefault()
         data2Mensagem.style.display = ""
    }
})

    function excluiraviso(){
        if (confirm("Deseja excluir esse aviso?")) {
            excluir.style.display = ""
            // window.location.href = ""
        } 
    }
