
<?php
session_start();
include_once('config.php');
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
</head>
<header>
    <?php
        $pergunta = "";
        //$id = $_SESSION['id'];
        $id = 2;
        $n = mt_rand(1,3);
        $resposta = "resposta_$n";
        $respostaSQL = array();
        $result = mysqli_query($conexao, "SELECT $resposta FROM administrador WHERE id = $id");        
        $resp = $result->fetch_all(MYSQLI_ASSOC);
        if(!isset($_SESSION['identificacao'])){
            // SE NÃO EXISTIR UM VALOR EM IDENTIFICAÇÃO ELE ENTRA NESSE BLOCO

            if ($result->num_rows > 0) {
                //SE ENCONTRAR ALGO NO BD ELE ENTRA NESSE BLOCO
                echo "AUTENTICAÇÃO 2FA";      
            
                $_SESSION['identificacao']=$resp[0][$resposta];

                if($n == 1){
                    $pergunta = "Qual o nome da sua mãe ?";
                }
                if($n == 2){
                    $pergunta = "Qual a sua data de nascimento ?";
                }
                if($n == 3){
                    $pergunta = "Qual o seu CEP ?";
                }
            } // else aqui caso o usuario nao seja encontrado no banco
        }
         
        
        if(isset($_POST['resposta'])){
            if($_POST['resposta'] === $_SESSION['identificacao']){
                echo "Permissão atendida";
            }
            else{
                echo "Permissão negada";
            }

        }
        

 
    ?>
</header>
<body>
    <h1> PERGUNTA SECRETA </h1>
    <?php
        echo "<br><br> <h3>$pergunta</h3>";
    ?>
    <form method="POST">
        <label for="resposta"> Resposta </label>
        <input type="text" name="resposta" id="resposta" placeholder="Digite sua resposta">
        <button type="submit">ENVIAR</button>
    </form>




    

    
</body>
</html>