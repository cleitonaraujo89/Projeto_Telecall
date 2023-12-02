document.getElementById('olho').addEventListener('mousedown', function () {
  document.getElementById('senha').type = 'text';
});

document.getElementById('olho').addEventListener('mouseup', function () {
  document.getElementById('senha').type = 'password';
});

// Para que o password não fique exposto apos mover a imagem.
document.getElementById('olho').addEventListener('mousemove', function () {
  document.getElementById('senha').type = 'password';
});

// OLHO RESPOSTA MASTER

document.getElementById('olho2').addEventListener('mousedown', function () {
  document.getElementById('resposta').type = 'text';
});

document.getElementById('olho2').addEventListener('mouseup', function () {
  document.getElementById('resposta').type = 'password';
});

// Para que o password não fique exposto apos mover a imagem.
document.getElementById('olho2').addEventListener('mousemove', function () {
  document.getElementById('resposta').type = 'password';
});

//limitar o input cpf para apenas numeros



