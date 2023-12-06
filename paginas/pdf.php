<?php 
    session_start();
    require_once'../dompdf/autoload.inc.php';
   
    //$dompdf->set_option('defaultFont','sans');
    if (!isset($_SESSION['master_autenticado'])) {
        // Redirecione para a página de login se não estiver autenticado
        header('Location: paginaErro.php');
        exit();
    }

    $dados = array();
    $msg=false; // controla a msg de alerta sem dados

    if(isset($_SESSION['dados'])){
        $dados = $_SESSION['dados'];

    } else{
      $msg = true;
    }
  /*   echo"<pre>";
    var_dump($_SESSION);
    echo"</pre>"; */
    
?>
<?php
    $html = "<!DOCTYPE html>";
    $html .= "<html lang='pt-br'>";
    $html .= "<head>";
        $html .= "<meta charset='UTF-8'>";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $html .= "<title>Impressão</title>";
        $html .= "<link rel='stylesheet' href='http://localhost/aulasGuanabara/projeto_Telecall/css/pdf.css'>";
    $html .= "</head>";
    $html .= "<body>";
    
        if($msg){
            $html .= "
                <div class='alerta'>
                    <h1><em> Não há dados para impressão! </em> </h1>
                    <h1> testando </h1>
                   
                </div>
            ";  
        }
        
        if(count($dados) > 0){ // conta se há cadastros no banco
            $html .= "<div>";
            $html .= "<h1> Uso Restrito </h1>";
            $html .= "<img src=\"http://localhost/aulasGuanabara/projeto_Telecall/imagens/logo-hdr2.png\">";
            $html .= "</div> ";
            $html .= "<table>";
            $html .= "<tr id='titulo'>"; // abre a linha da  tabela
            $titulos = array_keys($dados[0]);// pega as chaves dos arrays

            foreach ($titulos as $titulo) {
                $tituloM = strtoupper($titulo);// transforma em maiusculo
                $html .= "<td> $tituloM </td>"; // cria a coluna com o nome do tutulo
            }
            
            $html .= "</tr>"; // encerra a linha da tabela

            for ($i=0; $i < count($dados); $i++){
                if($i %2== 0){ // alterando cores das linhas
                    $html .= "<tr class='clara'> ";
                }else{
                    $html .= "<tr>";
                }
                
                foreach ($dados[$i] as $k => $v){
                    //adicionando valores aos campos
                    $html .= "<td> $v </td>";
                    
                }
            }

            $html .= "</table>";
        }
 
        $html .= "</body>";
        $html .= "</html>";
    
    //var_dump($html);
    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf(['enable_remote' => true]);
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','landscape');
    $dompdf->render();
    
    $dompdf->stream();
    //var_dump($html);
    
        
    ?>