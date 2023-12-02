// aceita somente numeros
$(document).ready(function () {
    $("#cpf").keyup(function () {
        $("#cpf").val(this.value.match(/[0-9]*/));
    });
});

//bloqueia numeros 
$(document).ready(function () {
  $("#nome").keyup(function () {
      $("#nome").val(this.value.replace(/[0-9]/g, ''));
  });
});
$(document).ready(function () {
  $("#nomeMae").keyup(function () {
      $("#nomeMae").val(this.value.replace(/[0-9]/g, ''));
  });
});

//função para avisar que o formulario foi enviado com sucesso
function i(){
    alert("sucess")
}

// FORMATANDO O CAMPO DATA DE NASCIMENTO
document.getElementById('data').addEventListener('input', function (event) {
    let input = event.target;
    let inputValue = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    if (inputValue.length > 2) {
      inputValue = inputValue.substring(0, 2) + '/' + inputValue.substring(2);
    }
    if (inputValue.length > 5) {
      inputValue = inputValue.substring(0, 5) + '/' + inputValue.substring(5, 9);
    }

    input.value = inputValue;
});

//FORMATANDO O CAMPO TELEFONE
document.getElementById('telefone').addEventListener('input', function (event) {
    let input = event.target;
    let inputValue = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    if (inputValue.length <= 2) {
      input.value = inputValue;
    } else if (inputValue.length <= 7) {
      input.value = `(+${inputValue.substring(0, 2)}) ${inputValue.substring(2)}`;
    } else {
      input.value = `(+${inputValue.substring(0, 2)}) ${inputValue.substring(2, 9)}-${inputValue.substring(9, 15)}`;
    }
  });

  //FORMATANDO O CAMPO TELEFONE FIXO
document.getElementById('telefone2').addEventListener('input', function (event) {
    let input = event.target;
    let inputValue = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    if (inputValue.length <= 2) {
      input.value = inputValue;
    } else if (inputValue.length <= 7) {
      input.value = `(+${inputValue.substring(0, 2)}) ${inputValue.substring(2)}`;
    } else {
      input.value = `(+${inputValue.substring(0, 2)}) ${inputValue.substring(2, 9)}-${inputValue.substring(9, 15)}`;
    }
  });