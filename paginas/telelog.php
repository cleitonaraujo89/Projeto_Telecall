<?php

    $conecta = include 'conecta.php';
    require_once 'usuarios.php';
    $u = new Usuario($conecta['db']);

    session_start();
    //session_destroy();
    $msg = false; // controla a exibição da msg e erro
    $msg2 = false;
    $master = false; // controla exibição do quadro de login Master

    //checando se o usuario já esta logado e redirecionando
    if(isset($_SESSION['usuario_logado'])){
        header('Location: areaCliente.php');
    }
    if(isset($_SESSION['master_autenticado'])){
        header('Location: areaMaster.php');
    }

    // Checando se o butão de login foi apertado
    if (isset($_POST['login'], $_POST['senha'])){
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);
        try {
            $res = $u->logar($login, $senha);
        } catch (Exception $e){
            header('Location: paginaErro.php');
        }
        if (!$res){
        // 1º checa se há um usuario, caso não encontre o usuario ativa a msg de erro
            $msg = true;
        } else {
            if ($res['admin'] > 0){
            // 2º tendo o usuário e caso seja master...
                $master = true; // ativa o quadro de login Master
                $nomeCompleto = explode(" ", $res['nome']);
                $nome = $nomeCompleto[0];
                $_SESSION['nome'] = $nome;
                $email = $res['email'];
                try {
                    $loginMaster = $u->master($email);
                } catch (Exception $e){
                    header('Location: paginaErro.php');
                }
                if (!$loginMaster){
                    $msg = true;
                    // caso o email informado não seja igual ao cadastro do master
                } else{
                    $_SESSION['master_logado'] = true;
                    $_SESSION['id']  = $loginMaster['id'];
                    $_SESSION['login']  = 'xxxx-xxxx';
                    $n = $loginMaster['n'];
                    $p = $loginMaster["pergunta_$n"]; 
                    // colocamos esse numero na session
                    $_SESSION['num'] = $n;
                    //caso contrario atribui um valor a session
                }

            } else {
            // 3º Não sendo master identificamos um usuário comum!
                $_SESSION['usuario_logado'] = true;
                $nomeCompleto = explode(" ", $res['nome']);
                $nome = $nomeCompleto[0];
                $_SESSION['nome'] = $nome;
                $_SESSION['login'] = $res['login'];
                $_SESSION['sexo'] = $res['sexo'];
                //atribui valores a session
                
                header('Location: areaCliente.php');
                // Redirecione para a página restrita usuario comun
                exit();
            }
        }
    }
    
    //CHECANDO DE O BOTÃO DE ENVIAR DA RESPOSTA FOI APERTADO
    if (isset($_POST['resposta'], $_SESSION['master_logado'], $_SESSION['num'])){
        $n = $_SESSION['num'];
        $resposta = addslashes($_POST['resposta']);
        $id = $_SESSION['id'];
        try {
            $checagem = $u->checaResposta($resposta, $n, $id);
        } catch (Exception $e){
            header('Location: paginaErro.php');
        }
        if($checagem){
            $_SESSION['master_autenticado'] = true;
            unset($_SESSION['master_logado']);
            unset($_SESSION['num']);
            unset($_SESSION['id']);
            header('Location: areaMaster.php');
            // Redirecione para a página restrita do usuario master

            exit();
        } else {
            session_destroy();
            $msg2 = true;
        }

       

    }
   /*  var_dump($_SESSION);
    echo "<br>";
    var_dump($_POST); */
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>Telecall-Login</title>
    <link rel="stylesheet" href="../css/telelog.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .alerta {
            display: flex; /* Ativa o layout flexível */
            align-items: center; /* Centraliza os itens verticalmente */
            justify-content: center;
            margin: 5vh auto -15vh auto;
        }

        .imgAlerta {
            width: 70px; /* Ajuste a largura conforme necessário */
            height: auto; /* Mantém a proporção da imagem */
            margin-right: 10px; /* Espaço à direita da imagem */
        }
        h4{
            margin-top: -20px;
        }
        #pc{
            
            color: #6f6f6f;
            text-align: center;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: large;
            font-weight: bold;
            margin-top: 15px;

        }
        #pc2{
            
            color: #C91C2B;
            text-align: center;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: large;
            font-weight: bold;
            margin-top: -15px;

        }
    </style>
</head>

<body class="fundo">

    <?php 
        if($msg){ // exibição da msg de erro usuario n encontrado
            echo "
                    <div class='alerta'>
                        <img src='../imagens/alert.png' alt='Alerta' class='imgAlerta'>
                        <em><h2>Usuario não encontrado!</h2></em>
                    </div>
                ";
        } 
        if($msg2){
            echo "
                    <div class='alerta'>
                        <img src='../imagens/alert.png' alt='Alerta' class='imgAlerta'>
                        <em><h2> Resposta Incorreta!</h2></em>
                    </div>
                ";
        }
    ?>
   
    <div class="identificador" style= "margin-top: 10vh;">
           <div class="login">
            <img src="../imagens/us1.svg" alt="Usuário">
            <h1>Login de Usuário</h1>
            
            <form method="post" >
               
                <div class="cpf">
                    <label for="login">Login</label><br />
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="login" id="cpf" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" minlength="" maxlength="8" placeholder="Digite seu Login">
                        <small>Error mensage</small>
                    </div>
                </div>
                <div class="senha">
                    <label for="senha">Senha</label><br />
                    <div class="input-group input-group-sm mb-3 input-olho">
                        <input type="password" name="senha" id="senha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Senha">
                        <p id="olho" class="olho"><i class="fa-solid fa-eye"></i></p>
                        <small>Error mensage</small>
                    </div>
                </div>
                <div class="footer d-flex justify-content-end">
                    <a id="cadastro" href="../paginas/cadastro.php">Cadastre-se</a>
                    <input type="submit" class="btn btn-danger" id="butao" value="Entrar">
                    <!-- <button type="submit" class="btn btn-danger" id="butao">Entrar</button><br /> -->
                </div>
                <a href="novaSenha.html" class="d-flex justify-content-end">Esqueceu a Senha?</a>
            </form>
        </div>
        <?php if(!$master){
            //Se não há master, tela comun é exibida
            echo "
                <div class='areaCliente'>
                    <a href='../index.php'><img src='../imagens/logo-telecall-1.png' alt='Logo Telecall'></a>
                    <div class='tituloAreaCliente'>
                        <img id='lock' src='../imagens/lock2.png' alt='Cadeado'>
                        <h2>Area do Cliente</h2>
                    </div>
                    <p>Aqui você encontra informações sobre sua conta, extrato telefônico, segunda via, histórico de mensagens e financeiro.</p>
                </div>";
            } else {
                // Sendo master a tela muda
                // trabalhamos o numero aleatório que chega pela função pra o loginMaster
              
                echo "
                        <div class= 'areaCliente'>
                            <a href= '../index.php'><img src='../imagens/logo-telecall-1.png' alt='Logo Telecall'></a>
                            
                            <em><h4>Seja bem vindo <br> $nome</h4></em>
                            <p id= 'pc'> Pergunta de confirmação: </p>                         
                            <p id= 'pc2'><em> $p </em></p>
                            <form class='senha' method='post'>
                                
                                <div class='input-group input-group-sm mb-3 input-olho'>
                                <input type='password' name='resposta' id='resposta'' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' placeholder='Responda aqui!'>
                                <p id='olho2' class='olho'><i class='fa-solid fa-eye'></i></p>
                                <small>Error mensage</small>
                                </div>
                                <input type='submit' value='Enviar'>
                            </form>
                        </form>
                        
                        
                    ";
            }
           
        ?>
    </div>
   
    <script type="text/javascript" src="../js/login.js"></script>
    <script type="text/javascript" src="../js/javaLog.js"></script>


</body>

</html>