const form = document.getElementById('form')
const log = document.getElementById('log')
const senha = document.getElementById('senha')
const novaSenha = document.getElementById('novaSenha')
const confirmarSenha = document.getElementById('confirmarSenha')
let sucesso = 0
//Evitar o comportamento padrão da pagina por meio do evento submit da tag de id form 
form.addEventListener('submit', (e)=>{
    e.preventDefault()
    check()
    if(sucesso === 4){
        form.submit();
    }
})

function check(){
    //Criar variaveis com os valores dos inputs e remover espaços em branco com o trim()
    const senhaValue = senha.value.trim()
    const logValue = log.value.trim()
    const confirmarSenhaValue = confirmarSenha.value.trim()
    const novaSenhaValue = novaSenha.value.trim()
    
    // VALIDA LOGIN
    if(logValue === ''){
        validarErro(log, 'Preencha esse campo')

    } else if(logValue.length < 8) {
        validarErro(log, 'Login deve conter 8 caractéres')

    } else{
        validarSucesso(log)
        sucesso += 1

    }


    //Validar senha
    if(senhaValue === ''){
        validarErro(senha, 'Preencha esse campo')

    } else if(senhaValue.length < 8) {
        validarErro(senha, 'A senha tem que ter no minimo 8 caracteres')

    } else{
        validarSucesso(senha)
        sucesso += 1

    }

    //Validar Nova Senha
    if(novaSenhaValue === ''){
        validarErro(novaSenha, 'Preencha esse campo')

    } else if(novaSenhaValue.length < 8) {
        validarErro(novaSenha, 'A senha tem que ter no minimo 8 caracteres')

    } else{
        validarSucesso(novaSenha)
        sucesso += 1

    }

    //Validar confirmarSenha
    if(confirmarSenhaValue === ''){
        validarErro(confirmarSenha, 'Preencha esse campo')

    } else if(confirmarSenhaValue !== novaSenhaValue) {
        validarErro(confirmarSenha, 'As senhas devem ser iguais')

    } else{
        validarSucesso(confirmarSenha)
        sucesso += 1

    }
    
    //Enviar caso todos os campos tenham 1 sucesso
   /*  if(sucesso == 11){
        console.log(nomeValue)
        console.log(cpfValue)
        console.log(emailValue)
        console.log(telefoneValue)
        console.log(senhaValue)
    } */
}

//Funções de validação

function validarErro(input, mensagem){
    const formControll = input.parentElement;
    const small = formControll.querySelector('small')
    small.innerText = mensagem

    formControll.className = 'input-group erro' //Adicionar a classe erro nos campos do formulario

}
function validarSucesso(input){
    const formControll = input.parentElement;

    formControll.className = 'input-group success' //Adicionar a classe success nos campos do formulario
}

function exibir(elementId) {
    var element = document.getElementById(elementId);

    if (element.style.display === 'none') {
        element.style.display = '';
    } else {
        element.style.display = 'none';
    }
}