const form = document.getElementById('form')
const cpf = document.getElementById('cpf')
const email = document.getElementById('email')
const senha = document.getElementById('senhaNova')
const confirmarSenha = document.getElementById('confirmarSenha')

//Evitar o comportamento padrão da pagina por meio do evento submit da tag de id form 
form.addEventListener('submit', (e)=>{
    e.preventDefault()

    check()  
})

function check(){
    const cpfValue = cpf.value.trim()
    const emailValue = email.value.trim()
    const senhalValue = senha.value.trim()
    const confirmarSenhaValue = confirmarSenha.value.trim()
    let sucesso = 0
    //Validar cpf
    if(cpfValue === ''){
        validarErro(cpf, 'Preencha esse campo')

    } else if(cpfValue.length < 11){
        validarErro(cpf, 'CPF ou CNPJ invalido')

    } else{
        validarSucesso(cpf)
        sucesso += 1
    }
    //Validar email
    if(emailValue === ''){
        validarErro(email, 'Preencha esse campo')

    } else if(validarEmail(emailValue) === false){
        validarErro(email, 'Email invalido')

    } else{
        validarSucesso(email)
        sucesso += 1
    }

    //Validar senha
    if(senhalValue === ''){
        validarErro(senha, 'Preencha esse campo')
    } else if(senhalValue.length < 8){
        validarErro(senha, 'A senha tem que ter no minimo 8 caracteres')
    } else{
        validarSucesso(senha)
        sucesso += 1
    }

    //Validar confirmar senha
    if(confirmarSenhaValue === ''){
        validarErro(confirmarSenha, 'Preencha esse campo')
    } else if(confirmarSenhaValue !== senhalValue){
        validarErro(confirmarSenha, 'As senhas devem ser iguais')
    } else{
        validarSucesso(confirmarSenha)
        sucesso +=1
    }

    if(sucesso === 4){
        console.log(cpfValue)
        console.log(emailValue)
        console.log(senhalValue)
        prompt('Insira o codigo de confirmação que enviamos para seu email')
    }
}

//Funções de validação
function validarEmail(email) {
    const emailPattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/gi
    return emailPattern.test(email)
}
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


