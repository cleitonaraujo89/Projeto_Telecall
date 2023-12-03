const form = document.getElementById('form')
const nome = document.getElementById('nome')
const cpf = document.getElementById('cpf')
const data = document.getElementById('data')
const nomeMae = document.getElementById('nomeMae')
const sexo = document.getElementById('sexoDiv')
const email = document.getElementById('email')
const telefone = document.getElementById('telefone')
const telefone2 = document.getElementById('telefone2')
const endereco = document.getElementById('endereco')
const log = document.getElementById('log')
const senha = document.getElementById('senha')
const confirmarSenha = document.getElementById('confirmarSenha')
let sucesso = 0
//Evitar o comportamento padrão da pagina por meio do evento submit da tag de id form 
form.addEventListener('submit', (e)=>{
    e.preventDefault()
    check()
    if(sucesso === 12){
        form.submit();
    } else {
        sucesso = 0;
    }
})

function check(){
    const cpfValue = cpf.value.trim() //Criar variaveis com os valores dos inputs e remover espaços em branco com o trim()
    const senhaValue = senha.value.trim()
    const nomeValue = nome.value.trim()
    const nomeMaeValue = nomeMae.value.trim()
    const emailValue = email.value.trim()
    const telefoneValue = telefone.value.trim()
    const telefone2Value = telefone2.value.trim()
    const enderecoValue = endereco.value.trim()
    const logValue = log.value.trim()
    const dataValue = data.value.trim()
    const confirmarSenhaValue = confirmarSenha.value.trim()
    

    //Validar nome
    if(nomeValue === ''){
        validarErro(nome, 'Preencha esse campo')

    } else{
        validarSucesso(nome)
        sucesso += 1
    }

    //Validar cpf
    if(cpfValue === ''){
        validarErro(cpf, 'Preencha esse campo')

    } else if(cpfValue.length < 11){
        validarErro(cpf, 'CPF ou CNPJ invalido')

    } else{
        validarSucesso(cpf)
        sucesso += 1
    }

    //Validar Data
    if(dataValue === ''){
        validarErro(data, 'Preencha esse campo')

    } else if(dataValue.length > 10) {
        validarErro(data, 'Exemplo: 18/07/1989')

    } else{
        validarSucesso(data)
        sucesso += 1

    }

    //Validar nome Materno
    if(nomeMaeValue === ''){
        validarErro(nomeMae, 'Preencha esse campo')

    } else{
        validarSucesso(nomeMae)
        sucesso += 1
    }

    //Validar Sexo
   
    // Obtém todos os elementos de rádio com o name "sexo"
    let opcoesSexo = document.querySelectorAll('input[name="sexo"]');

    // Verifica se pelo menos uma opção foi selecionada
    let peloMenosUmaSelecionada = Array.from(opcoesSexo).some(opcao => opcao.checked);

    if (peloMenosUmaSelecionada) {
        sucesso += 1
        sexo.style.border = "none";
    } else {
        sexo.style.border = "3px solid #f13232ea";        
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
    //Validar telefone
    if(telefoneValue === ''){
        validarErro(telefone, 'Preencha esse campo')

    } else if(telefoneValue.length < 11) {
        validarErro(telefone, 'Exemplo: 21 999999999')

    } else{
        validarSucesso(telefone)
        sucesso += 1

    }

    // VALIDA TELEFONE FIXO
    if(telefone2Value === ''){
        validarErro(telefone2, 'Preencha esse campo')

    } else if(telefoneValue.length < 11) {
        validarErro(telefone2, 'Exemplo: 21 999999999')

    } else{
        validarSucesso(telefone2)
        sucesso += 1

    }

    // VALIDA ENDEREÇO
    if(enderecoValue === ''){
        validarErro(endereco, 'Preencha esse campo')

    } else if(telefoneValue.length < 11) {
        validarErro(endereco, 'Exemplo: 21 999999999')

    } else{
        validarSucesso(endereco)
        sucesso += 1

    }

    // VALIDA LOGIN
    if(logValue === ''){
        validarErro(log, 'Preencha esse campo')

    } else if(telefoneValue.length < 11) {
        validarErro(log, 'Exemplo: 21 999999999')

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
    //Validar confirmarSenha
    if(confirmarSenhaValue === ''){
        validarErro(confirmarSenha, 'Preencha esse campo')

    } else if(confirmarSenhaValue !== senhaValue) {
        validarErro(confirmarSenha, 'As senhas devem ser iguais')

    } else{
        validarSucesso(confirmarSenha)
        sucesso += 1

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

