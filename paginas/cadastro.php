<?php 

    $conecta = include 'conecta.php';
    require_once 'usuarios.php';
    $u = new Usuario($conecta['db']);

    $msg = false; // controla exibição do conteudo na tela
    $msg2 = false;

    if(isset($_POST['log'], $_POST['senha'], $_POST['email'], $_POST['cpf'])){
        $nome = addslashes($_POST['nome']);
        $data = $_POST['data'];
        $cpf = addslashes($_POST['cpf']);
        $nomeMae = addslashes($_POST['nomeMae']);
        $sexo = addslashes($_POST['sexo']);
        $email = addslashes($_POST['email']);
        $telefone = addslashes($_POST['telefone']);
        $telefoneFixo = addslashes($_POST['telefone2']);
        $cep = addslashes($_POST['cep']);
        $estado = addslashes($_POST['estado']);
        $rua = addslashes($_POST['rua']);
        $numero = addslashes($_POST['numero']);
        $complemento = addslashes($_POST['complemento']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $login = addslashes($_POST['log']);
        $senha = addslashes($_POST['senha']);
        try {
            $cadastrando = $u->cadastrarUsuario($nome, $data, $cpf, $nomeMae, $sexo, $email, $telefone, $telefoneFixo, $cep, $estado, $rua, $numero, $complemento, $bairro, $cidade, $login, $senha);
        } catch (Exception $e){
            //header('Location: paginaErro.php');
            var_dump($e);
            echo 'deu ruim';
        }
        if(!$cadastrando){
            $msg = true;
        } else {
            $msg2 = true;
        }

    }
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>Telecall-Cadastro</title>
    <link rel="stylesheet" href="../css/telelog.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/logcss.css">

    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .alerta {
            display: flex; /* Ativa o layout flexível */
            align-items: center; /* Centraliza os itens verticalmente */
            justify-content: center;
            margin: 5vh auto -7vh auto;
        }

        .imgAlerta {
            width: 70px; /* Ajuste a largura conforme necessário */
            height: auto; /* Mantém a proporção da imagem */
            margin-right: 10px; /* Espaço à direita da imagem */
        }
        h4{
            margin-top: -20px;
        }
        #pr{
            
            color: #6f6f6f;
            text-align: center;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: large;
            font-weight: bold;
            margin: 6vh auto -5vh auto;

        }
    </style>
    <script>
        // JavaScript para redirecionar após um determinado tempo
        function redirecionar(){
            setTimeout(function() {
                window.location.href = 'telelog.php';
            }, 3000); // 3000 milissegundos = 3 segundos
        }
    </script>

</head>
<body class="fundo">
<?php

    if($msg){ // exibição da msg de erro usuario n encontrado
        echo "
                <div class='alerta'>
                    <img src='../imagens/alert.png' alt='Alerta' class='imgAlerta'>
                    <em><h2>E-Mail, Login ou CPF já cadastrado!</h2></em>
                </div>
            ";
    } 
    if($msg2){ // exibição da msg de erro usuario n encontrado
        echo "
                <div class='alerta'>
                    <img src='../imagens/sucess.png' alt='Alerta' class='imgAlerta'>
                    <em><h2>Cadastro Realizado com Sucesso!</h2></em>
                </div>
                <em><p id='pr'>redirecionando...</p></em>
                <script> redirecionar(); </script>
            ";
    } 

?>
    <div class="identificador">
        
        <div class="login">
            <div class="titulo">
                <a href="../index.php"><img class="logo" src="../imagens/logoptd.png" alt="logo"></a>
                <h1 class="h1Cad">Cadastro de Usuário</h1>
            </div>
            <form  id="form" method="post">
                <div class="nome">
                    <label for="nome">Nome Completo</label><br/>
                    <div class="input-group input-group-sm">
                        <input onkeyup="maisculo(this)" type="text" name="nome" id="nome" minlenght="15" maxlength="80" class="form-control" pattern="[^0-9]*" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nome" >
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div>
                    
                </div>
                <div class="formGrid">
                    <div class="data">
                        <label for="data">Data de Nascimento</label><br/>
                        <div class="input-group input-group-sm">
                            <input  type="text" name="data" id="data" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="DD/MM/AAAA" maxlength="10">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="cpf">
                        <label for="cpf">CPF</label><br/>
                        <div class="input-group input-group-sm">
                            <input type="text" name="cpf" id="cpf" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" minlength="11" maxlength="14" placeholder="Seu CPF">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                </div>
                <div class="nomeMae">
                    <label for="nomeMae">Nome Materno</label><br/>
                    <div class="input-group input-group-sm">
                        <input onkeyup="maisculo(this)" type="text" name="nomeMae" id="nomeMae" class="form-control" aria-label="Sizing example input" pattern="[^0-9]*" aria-describedby="inputGroup-sizing-sm" placeholder="Ex: Maria silva ">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div> 
                </div>
                <div class="sexo" >
                    <label for="sexo">Sexo</label><br/>
                    <div class="input-group input-group-sm" id="sexoDiv">
                        <label for="sex1">Masculino <input type="radio" name="sexo" id="sex1"  value="Masculino"></label>
                        <label for="sexo" id="lb2"> &nbsp;&nbsp;&nbsp;Feminino <input type="radio" name="sexo" id="sexo"  value="Feminino"></label>
                    </div>
                </div>

                <div class="email">
                    <label for="email">Email</label><br/>
                    <div class="input-group input-group-sm ">
                        <input type="text" name="email" id="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="exemplo@provedor.com">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div>
                </div>
                <div class="telefone">
                    <label for="telefone">Telefone</label><br/>
                    <div class="input-group input-group-sm ">
                        <input type="text" name="telefone" id="telefone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  placeholder="(+55)XX-XXXXXXXXX">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div>
                </div>
                    <div class="telefone2">
                    <label for="telefone2">Telefone Fixo</label><br/>
                    <div class="input-group input-group-sm ">
                        <input type="text" name="telefone2" id="telefone2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  placeholder="(+55)XX-XXXXXXXXX">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div>
                </div>
                <div class="formGrid">
                    <div class="cep">
                        <label for="cep">CEP</label><br/>
                        <div class="input-group input-group-sm">
                            <input  type="text" name="cep" id="cep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="xxxxx-xxx" maxlength="9">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="estado">
                        <label for="estado">Estado</label><br/>
                        <div class="input-group input-group-sm">
                            <input type="text" name="estado" id="estado" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" minlength="2" maxlength="2" placeholder="XX">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                </div>
                <div class="rua">
                    <label for="rua">Rua</label><br/>
                    <div class="input-group input-group-sm">
                        <input onkeyup="maisculo(this)" type="text" name="rua" id="rua" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Digite o logradouro">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div> 
                </div>
                <div class="formGrid">
                    <div class="numero">
                        <label for="numero">Número</label><br/>
                        <div class="input-group input-group-sm">
                            <input  type="text" name="numero" id="numero" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="1234" maxlength="10">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="complemento">
                        <label for="complemento">Complemento</label><br/>
                        <div class="input-group input-group-sm">
                            <input type="text" name="complemento" id="complemento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  maxlength="100">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                </div>
                <div class="formGrid">
                    <div class="bairro">
                        <label for="bairro">Bairro</label><br/>
                        <div class="input-group input-group-sm">
                            <input  type="text" name="bairro" id="bairro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Digite seu Bairro">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    <div class="cidade">
                        <label for="cidade">Cidade</label><br/>
                        <div class="input-group input-group-sm">
                            <input type="text" name="cidade" id="cidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Digite sua Cidade">
                            <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                            <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                            <small>Error mensage</small>
                        </div>
                    </div>
                    
                </div>
                <div class="log">
                    <label for="log">Login</label><br/>
                    <div class="input-group input-group-sm">
                        <input onkeyup="maisculo(this)" type="text" name="log" id="log" class="form-control" maxLenght="8" minLenght="8" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Seu login com 8 caracteres">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div> 
                </div>
                <div class="senha">
                    <label for="senha">Senha</label><br/>
                    <div class="input-group input-group-sm ">
                        <input type="password" name="senha" id="senha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  maxlength="30" placeholder="Senha">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div>
                </div>
                <div class="confirmarSenha">
                    <label for="confirmarSenha">Confirmar Senha</label><br/>
                    <div class="input-group input-group-sm ">
                        <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="30" placeholder="Confirmar Senha">
                        <i><img class="imgSucesso" src="../imagens/success-icon.svg" alt="sucesso"></i>
                        <i><img class="imgErro" src="../imagens/error-icon.svg" alt=""></i>
                        <small>Error mensage</small>
                    </div>
                </div>
                <div class="flexcad">
                    <div class="footerCadastro">
                        <button type="submit" class="btn btn-danger" id="cad">Cadastrar</button><br>
                    </div>
                    <div class="footerCadastro">
                        <a  class="btn btn-danger" id="cad" href="cadastro.php">Limpar</a><br>
                    </div>
                </div>
            </form>
        </div>      
    </div>
    <script type="text/javascript" src="../js/cad.js"></script>
    <script type="text/javascript" src="../js/java.js"></script>

</body>

</html>