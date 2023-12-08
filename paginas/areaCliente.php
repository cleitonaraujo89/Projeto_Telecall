<?php
session_start();
$conecta = include 'conecta.php';
require_once 'usuarios.php';
$u = new Usuario($conecta['db']);

$msg = 0;

// Verifique se o usuário está autenticado
if (!isset($_SESSION['usuario_logado'])) {
    // Redirecione para a página de login se não estiver autenticado
    header('Location: telelog.php');
    exit();
}


if (isset($_SESSION['nome'], $_SESSION['sexo'])) {
    $nome = ucfirst($_SESSION['nome']);
    $sexo = $_SESSION['sexo'];
    if ($sexo == 'Masculino') {
        $sex = 'o';
    } else {
        $sex = 'a';
    }
}

if (isset($_POST['log'], $_POST['senha'])) {
    $login = addslashes($_POST['log']);
    $senha = addslashes($_POST['senha']);
    $novaSenha = addslashes($_POST['novaSenha']);
    if ($login != $_SESSION['login']) {
        $res = false;
    } else {
        try {
            $res = $u->alterarSenha($login, $senha, $novaSenha);
        } catch (Exception $e) {
            header('Location: paginaErro.php');
        }
        if (!$res) {
            // 1º checa se há um usuario, caso não encontre o usuario ativa a msg de erro
            $msg = 1;

        } else {
            $msg = 2;

        }
    }
}

/* var_dump($_SESSION);
echo "<br>";
var_dump($_POST); */
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>Area do Cliente</title>
    <link rel="stylesheet" href="../css/telelog.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/logcss.css">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <style>
        .center {
            text-align: center;
        }

        h1 {
            font-family: "Berlin Sans FB Demi";
            margin-top: 5vh;
            font-size: 4em;

        }

        span {
            color: #C91C2B;
        }

        h2 {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-style: italic;

        }

        h3 {
            font-family: "Berlin Sans FB Demi";
            font-style: italic;
            color: #0b5ed7;
        }

        #div2 {
            display: flex;
        }

        .img_cards {
            transition: box-shadow 0.3s;
            box-shadow: 2px 3px 8px rgba(0, 0, 0, 0.2);
        }

        img:hover {
            box-shadow: 10px 10px 8px rgba(0, 0, 0, 0.5);
        }

        #img1 {
            height: auto;
            width: 60%;
            margin: 0px;
            border-radius: 10px;
        }

        #img2 {
            height: auto;
            width: 35%;
            margin: 0px;
            border-radius: 10px;
        }

        .alerta {
            display: flex;
            /* Ativa o layout flexível */
            align-items: center;
            /* Centraliza os itens verticalmente */
            justify-content: center;
            margin: 5vh auto -15vh auto;
        }

        .imgAlerta {
            width: 70px;
            /* Ajuste a largura conforme necessário */
            height: auto;
            /* Mantém a proporção da imagem */
            margin-right: 10px;
            /* Espaço à direita da imagem */
        }
    </style>
</head>
<header>
    <!-- Primeira barra de navegação -->
    <nav id="navtop" class="navbar navbar-expand navbar-dark bg-dark  " aria-label="primeira">
        <div class="container-fluid ">
            <div class="collapse navbar-collapse " id="navbarsExample02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Wholesale</a>
                    </li>
                    <div class="collapse navbar-collapse " id="navbarsExample02">
                        <ul class="nav-item">
                            <a class="nav-link active" id="cliente" aria-current="page" href="paginas/telelog.php">Area
                                do Cliente</a>
                        </ul>

                    </div>
                </ul>

            </div>
            <!--modo escuro-->
            <!-- <div>
              <input type="checkbox"class="checkbox" id="darkmode"/>
      
              <label class="label"for="darkmode">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun"></i>
                <div class="ball"></div>
              </label>
      
            </div> -->
        </div>
    </nav>
    <!-- segunda barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark  segundanav" aria-label="segunda">
        <div class="container-fluid  ">
            <a class="navbar-brand" href="../index.php"><img class= "img" src="../imagens/logo-hdr.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link  active " href="paginas/produtos.php#pinternet"
                            aria-expanded="false">Internet</a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  active" href="paginas/produtos.php#ptelefonia"
                            aria-expanded="false">Telefonia</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  active" href="paginas/produtos.php#prede" aria-expanded="false">Redes e
                            Infraestrutura</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  active" href="paginas/produtos.php#pmobilidade"
                            aria-expanded="false">Mobilidade</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  active" href="paginas/produtos.php#peventos"
                            aria-expanded="false">Eventos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  active" href="paginas/produtos.php#psolucoes" aria-expanded="false">Outras
                            Soluções</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php 
        echo"
            <div class='fr'>
                <a href='telelog.php'><img class='imgloginHeader'src='../imagens/iconlogin.jpg' alt='User' ></a>
                <div>             
                    <p class='nomeLog'> $nome </p>            
                    <a class ='nomeLog' href='logout.php'>Logout</a>  
                </div>
            </div>
         
        ";
    ?>
</header>

<body class='fundo'>
    <main>
        <?php
        echo "
                <div class= 'center'>
                    <h1><span>S</span>eja bem vind$sex<span>!</span></h1>
                    <h2>$nome</h2>
                </div>
            ";
        ?>

        <div id='div2'>
            <div class="center">
                <h3>Conheça nossas Promoções!</h3>
                <a href="produtos.php"> <img class='img_cards' id='img1' src="../imagens/black.png" alt="Produtos"
                        srcset=""></a>

            </div>
            <div class="center">
                <h3>Alterar Senha</h3>
                <a href="#"><img id='img2' class='img_cards' src="../imagens/senha-segura.png" alt="Alterar senha"
                        onclick="exibir('alterar')"></a>

            </div>
        </div>

        <div class="identificador" id='alterar' style="display: none;">

            <div class="login" id='change'>
                <div class="titulo">
                    <img class="logo" src="../imagens/logoptd.png" alt="logo">
                    <h1 class="h1Cad">Alteração de senha</h1>
                </div>
                <form id="form" method="post">
                    <div class="log">
                        <label for="log">Login</label><br />
                        <div class="input-group input-group-sm">
                            <input onkeyup="maisculo(this)" type="text" name="log" id="log" class="form-control"
                                maxLenght="8" minLenght="8" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" placeholder="Seu login com 8 caracteres">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="senha">
                        <label for="senha">Senha</label><br />
                        <div class="input-group input-group-sm ">
                            <input type="password" name="senha" id="senha" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="30"
                                placeholder="Senha">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="senha">
                        <label for="senha">Nova Senha</label><br />
                        <div class="input-group input-group-sm ">
                            <input type="password" name="novaSenha" id="novaSenha" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" minlength="8"
                                maxlength="30" placeholder="Senha">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="confirmarSenha">
                        <label for="confirmarSenha">Confirmar Senha</label><br />
                        <div class="input-group input-group-sm ">
                            <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" minlength="8"
                                maxlength="30" placeholder="Confirmar Senha">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="flexcad">
                        <div class="footerCadastro">
                            <button type="submit" class="btn btn-danger" id="cad">Alterar</button><br>
                        </div>
                        <div class="footerCadastro">
                            <a class="btn btn-danger" id="cad" href="areaCliente.php?Alterar=true">Limpar</a><br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        
        if ($msg === 1) { // exibição da msg de erro usuario n encontrado
            echo "
                        <div class='alerta'>
                            <img src='../imagens/alert.png' alt='Alerta' class='imgAlerta'>
                            <em><h2>Usuario não encontrado!</h2></em>
                        </div>
                    ";
        }
        if ($msg === 2) {
            echo "
                        <div class='alerta'>
                            <img src='../imagens/sucess.png' alt='Alerta' class='imgAlerta'>
                            <em><h2>Alteração Realizada com Sucesso!</h2></em>
                        </div>
                    ";
            $msg=0;        
        }

        
        ?>
    </main>



    <script type="text/javascript" src="../js/javacliente.js"></script>

</body>

</html>