<?php
    session_start();
    $conecta = include 'conecta.php';
    require_once 'usuarios.php';
    $u = new Usuario($conecta['db']);


    //Verifique se o usuário está autenticado
     if (!isset($_SESSION['master_autenticado'])) {
        // Redirecione para a página de login se não estiver autenticado
        header('Location: paginaErro.php');
        exit();
    } 
   /*  var_dump($_POST);
    echo'<br>'; 
    echo'<br> -------------------';*/
   
    $dados = array();
    
    if (isset($_POST['cpf_digitado'])){
       try{
            $dados = $u->consultar($_POST);
            
        } catch (Exception $e){
            header('Location: paginaErro.php');
        }
    }
    //var_dump($dados);
    if(isset($_GET['id'])){
        $id_pessoa = addslashes($_GET['id']);
        try{
            $u->excluirCadastro($id_pessoa);
            header("location: areaMaster.php");
        } catch (Exception $e){
            header('Location: paginaErro.php');
        }
        
    }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/areaMaster.css">
    <title>Area Master</title>
</head>
<body>
  
    <section id="esquerda">
        <form method="post" class="br">
            <h2>Informações Desejadas:</h2>
        
            <div class="radio">
                <label for="id">Id</label class="">
                <input type="checkbox" name="id" id="" value="id" class="ml mr"> 

                <label for="nome">Nome</label class="">
                <input type="checkbox" name="nome" id="" value="nome" class="ml mr"> 

                <label for="cpf">CPF</label class="">
                <input type="checkbox" name="cpf" id="" value="cpf" class="ml mr">

                <label for="data">Data</label class="lb">
                <input type="checkbox" name="data" id="" value="data" class="ml mr">

                <label for="sexo">Sexo</label class="lb">
                <input type="checkbox" name="sexo" id="" value="sexo" class="ml mr">             
            </div> 
            <div class="radio">
                <label for="telefone">Tel.</label class="">
                <input type="checkbox" name="telefone" id="telefone" value="telefone" class="ml mr">

                <label for="telefoneFixo">Tel.F</label class="">
                <input type="checkbox" name="telefoneFixo" id="" value="telefoneFixo" class="ml mr"> 

                <label for="endereco">End.</label class="">
                <input type="checkbox" name="endereco" id="" value="endereco" class="ml mr">

                <label for="complemento">Comp.</label class="">
                <input type="checkbox" name="complemento" id="" value="complemento" class="ml mr">

                <label for="mae">Mae</label class="lb">
                <input type="checkbox" name="nomeMae" id="mae" value="nomeMae" class="ml">

            </div>
            <h2 class="mt">Filtro de pesquisa</h2>
                    
            <label for="nome_digitado">Nome</label>
            <input type="text" name="nome_digitado" id="nome_digitado" value="<?php if(isset($res)){echo $res['nome'];}?>">
            <label for="cpf_digitado">CPF</label>
            <input type="text" name="cpf_digitado" id="cpf_digitado" value="<?php if(isset($res)){echo $res['telefone'];}?>">
            <label for="email_digitado">Email</label>
            <input type="email_digitado" name="email_digitado" id="email_digitado" value="<?php if(isset($res)){echo $res['email'];} ?>">
            <label for="id_digitado">ID</label>
            <input type="id_digitado" name="id_digitado" id="id_digitado" value="<?php if(isset($res)){echo $res['email'];} ?>">
            <input class="inputbotao" type="submit" value="Pesquisar">
        </form>
        <div class= 'botoesm'>
            <a href="modelo.php"><button class="butaomaster">Modelo BD</button></a>
            <a href="logout.php"><button class="butaomaster">Deslogar</button></a>
        </div>
    </section>
    <section id="direita">
        <table>
     
        <?php 
            
            if(count($dados) > 0){ // conta se há cadastros no banco
                echo'<tr id="titulo">';
                $titulos = array_keys($dados[0]);
    
                foreach ($titulos as $titulo) {
                    $tituloM = strtoupper($titulo);
                    echo "<td> $tituloM </td>";
                }
                echo "<td>  </td>";
                echo'</tr>';

                for ($i=0; $i < count($dados); $i++){
                    if($i %2== 0){
                        echo "<tr class='clara'> ";
                    }else{
                        echo "<tr>";
                    }
                    
                    foreach ($dados[$i] as $k => $v){
                        
                       echo "<td> $v </td>";
                        
                    }
                    
                
                    echo "<td><a href=\"areaMaster.php?id=".$dados[$i]['id']."\"><button id=\"bt2\">Excluir</button></a></td>";
                    echo "</tr>";

                }
            } else {
            ?> <!-- dividiu o php pra colocar html, o else esta aberto-->

                <tr id="titulo">
                    <td>Seja bem vindo Administrador!</td>
                </tr> 
            </table>            

                
                <div class="aviso">
                <img id="seta" src="../imagens/setamaster.png">
                <h2 id="h2seta">Selecione as opções de pesquisa</h2>
                </div>  
                
            <?php
            } // fechamento do else
        ?>

        
        
        
    </section>
    
</body>
</html>



