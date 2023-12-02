<?php
    session_start();

    session_destroy();


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Erro</title>
    <style>
        *{
            margin = 0px;

        }
        main{
            align-items: center;
            justify-content: center;
        }
        #div1 {
            display: flex; /* Ativa o layout flexível */
            align-items: center; /* Centraliza os itens verticalmente */
            justify-content: center;
            margin: 5vh auto ;
        }

        #img1 {
            width: 150px; /* Ajuste a largura conforme necessário */
            height: auto; /* Mantém a proporção da imagem */
            margin-right: 10px; /* Espaço à direita da imagem */
        }
        h1{
            font-size: 30pt ;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        }
        #div2{
            display: block;
            align-content: center;
            text-align: center;
        }
        span{
            color: #C91C2B;
        }
        h2{
            margin-top: -25px;
            text-align: center;
            color: #0a58ca;
        }
        h3{
            font-style: italic;
            font-family: "Noto Serif", "DejaVu Serif", serif;
            color: #C91C2B;
        }
        #img2{
            width: 150px;
            height: auto;
        }
       
        
    </style>
    <script>
        //JavaScript para redirecionar após um determinado tempo
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 6000); // 6000 milissegundos = 6 segundos

    </script>
</head>
<body>
    <main>
        <div id='div1'>
            <img src="../imagens/ops.avif" alt='Oops' id='img1'>
            <em><h1><span>P</span>arece que algo deu errado<span>...</span></h1></em>
        </div>
        <div id='div2'>
            <h2>Mas não se preocupe vamos redirecionar você!</h2>
            <h3>Faça login novamente!</h3>
            <a href="../index.php"> <img id="img2" src="../imagens/logo-hdr2.png" alt="Telecall"></a>
        </div>

    </main>
</body>
</html>