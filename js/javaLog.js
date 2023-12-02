const form = document.getElementById('formLog')
const cpf = document.getElementById('cpf')
const senha = document.getElementById('senha')

form.addEventListener('submit', (e) => {
    e.preventDefault()
    
    checkLog()  
})

function checkLog(){
    const cpfValue = cpf.value.trim()
    const senhaValue = senha.value.trim()
    let success = 0
    //Validar cpf
    if(cpfValue === ''){
        validarErro(cpf, 'Preencha esse campo')

    } else if(cpfValue.length < 8){
        validarErro(cpf, 'CPF ou CNPJ invalido')

    } else{
        validarSucesso(cpf)
        success += 1
    }

    //Validar senha
    if(senhaValue === ''){
        validarErro(senha, 'Preencha esse campo')

    } else{
        validarSucesso(senha)
        success += 1
    }
    //Testar Validação 2 success, vai pra pagina principal
    /* if(success === 2){
        alert('Teste de validação bem sucedido, Bem Vindo!')
        window.location.href = '../index.html'
    } */
}

function validarErro(input, mensagem){
    //const formControll = input.parentElement;
    const small = formControll.querySelector('small')
    small.innerText = mensagem

    formControll.className = 'input-group erro' //Adicionar a classe erro nos campos do formulario

}
function validarSucesso(input){
    const formControll = input.parentElement;

    formControll.className = 'input-group success' //Adicionar a classe success nos campos do formulario
}