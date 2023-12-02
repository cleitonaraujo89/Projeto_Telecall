<?php
session_start();
$logado = false;
if (isset($_SESSION['usuario_logado']) || isset($_SESSION['master_autenticado'])) {
    $nome = $_SESSION['nome'];
    $logado = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>Telecall - Soluções completas em telefonia e internet</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <!-- Primeira barra de navegação -->
        <nav id="navtop" class="navbar navbar-expand navbar-dark bg-dark  " aria-label="primeira">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse " id="navbarsExample02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Empresas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Wholesale</a>
                        </li>
                        <div class="collapse navbar-collapse " id="navbarsExample02">
                            <ul class="nav-item">
                                <a class="nav-link active" id="cliente" aria-current="page" href="telelog.php">Area do
                                    Cliente</a>
                            </ul>

                        </div>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- segunda barra de navegação -->
        <nav class="navbar navbar-expand-lg navbar-dark  " aria-label="segunda">
            <div class="container-fluid  ">
                <a class="navbar-brand" href="../index.php"><img class="img" src="../imagens/logo-hdr.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link  active " href="produtos.php#pinternet"
                                aria-expanded="false">Internet</a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  active" href="produtos.php#ptelefonia"
                                aria-expanded="false">Telefonia</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  active" href="produtos.php#prede" aria-expanded="false">Redes e
                                Infraestrutura</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  active" href="produtos.php#pmobilidade"
                                aria-expanded="false">Mobilidade</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  active" href="produtos.php#peventos" aria-expanded="false">Eventos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  active" href="produtos.php#psolucoes" aria-expanded="false">Outras
                                Soluções</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php 
      if ($logado){
        echo"
        <div class='fr'>
          <a href='paginas/telelog.php'><img class='imgloginHeader'src='../imagens/iconlogin.jpg' alt='User' ></a>
          <div>             
            <p class='nomeLog'> $nome </p>            
            <a class ='nomeLog' href='logout.php'>Logout</a>  
          </div>
        </div>
        
        ";
      }
    ?>
    </header>
    <main>
        <h1 class="fonteconthrax">Conheça Nossos Produtos e Serviços</h1>
        <!-- INTERNET -->
        <h1 class="h1produtos" id="pinternet">Serviços de Internet</h1>
        <h3 class="h3produtos">Soluções de internet em fibra de altíssima velocidade.</h3>
        <div class="flexprodutos">
            <div class="itensprodutos">
                <img src="../imagens/internet.svg" alt="internet icone">
                <h2>Internet Dedicada</h2>
                <p>Internet dedicada de máxima qualidade,
                    disponibilidade e segurança.</p>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/cabo.svg" alt="incone banda larga">
                <h2>Banda larga</h2>
                <p>Internet em fibra ótica de alta qualidade e velocidade.</p>
                <br>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/roteador.svg" alt="roteador icone">
                <h2>WI-FI</h2>
                <p>Internet sem fio de alta performance.</p>
                <br>
                <a href="#">Saiba Mais</a>
            </div>
        </div>
        <!-- TELEFONIA -->
        <h1 class="h1produtos" id="ptelefonia">Serviços de Telefonia</h1>
        <h3 class="h3produtos">Aproveite os benefícios de uma telefonia inteligente, inovadora e integrada.</h3>
        <div class="flexprodutos">
            <div class="itensprodutos">
                <img src="../imagens/fax.svg" alt="internet icone">
                <h2>PABX IP Virtual</h2>
                <p>Todos os benefícios que uma telefonia IP de alta qualidade pode oferecer para sua empresa.</p>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/ligacoes.svg" alt="incone banda larga">
                <h2>E1</h2>
                <p>Solução de telefonia digital para realização de até 30 ligações simultâneas.</p>
                <br>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/redegrade.svg" alt="roteador icone">
                <h2>SIP TRUNK</h2>
                <p>Solução de telefonia para empresas com PABX IP.</p>
                <br><br>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/torre.svg" alt="roteador icone">
                <h2>Números 0800 <br> e 40XX</h2>
                <p>Números 0800 e 40XX para serem usados de acordo com a necessidade de sua empresa.</p>
                <a href="#">Saiba Mais</a>
            </div>
        </div>
        <!-- REDE E INFRAESTRUTURA -->
        <h1 class="h1produtos" id="prede">Serviços de Rede e Infraestrutura</h1>
        <h3 class="h3produtos">Soluções sob medida para sua empresa.</h3>
        <div class="flexprodutos">
            <div class="itensprodutos">
                <img src="../imagens/sisten.svg" alt="">
                <h2>Ponto-a-Ponto</h2>
                <p>Acesso dedicado para ligação entre dois pontos.</p>
                <br>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/cloud.svg" alt="">
                <h2>MPLS</h2>
                <p>Formação de rede com protocolo MPLS.</p>
                <br>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/chip.svg" alt="">
                <h2>Fibra Apagada e Dutos</h2>
                <p>Locação de fibra apagada <br> e dutos entre dois pontos.</p>

                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/server.svg" alt="">
                <h2>Co-location</h2>
                <p>Locação de espaço em rack em datacenter próprio.</p>
                <br>
                <a href="#">Saiba Mais</a>
            </div>
        </div>
        <!-- MOBILIDADE -->
        <h1 class="h1produtos" id="pmobilidade">Serviços de Mobilidade</h1>
        <h3 class="h3produtos">Soluções de telefonia movel para sua empresa.</h3>
        <div class="flexprodutos">
            <div class="itensprodutos">
                <img src="../imagens/phone.svg" alt="internet icone">
                <h2>Celular Empresarial</h2>
                <p>Pague apenas pelo que você precisa! Mais rápido, pratico e seguro.</p>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/simcard.svg" alt="incone banda larga">
                <h2>MVNA/E</h2>
                <p>Com a Telecall, sua empresa pode se tornar uma operadora celular (MVNO) e oferecer seu próprio SIM
                    card.</p>

                <a href="#">Saiba Mais</a>
            </div>
        </div>
        <!-- EVENTOS -->
        <h1 class="h1produtos" id="peventos">Serviços para Eventos</h1>
        <h3 class="h3produtos">Soluções temporárias para seu evento.</h3>
        <div class="flexprodutos">
            <div class="itensprodutos">
                <img src="../imagens/internet.svg" alt="internet icone">
                <h2>Link Dedicado Temporário Wi-fi</h2>
                <p>Conexão com uso de rede cabeada e Wi-Fi para eventos de todos os portes.</p>
                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/roteador.svg" alt="incone banda larga">
                <h2>Hotspot</h2>
                <p>Disponibilize acesso grátis à internet através de login social ou registro de e-mail com o Hotspot.
                </p>

                <a href="#">Saiba Mais</a>
            </div>
            <div class="itensprodutos">
                <img src="../imagens/fax.svg" alt="roteador icone">
                <h2>PABX IP Virtual Temporário</h2>
                <p>Solução de telefonia temporária para eventos. Contempla o fornecimento de aparelhos.</p>
                <a href="#">Saiba Mais</a>
            </div>
        </div>
        <!-- OUTRAS SOLUÇÕES -->
        <h1 class="h1produtos" id="psolucoes">Outras Soluções</h1>
        <h3 class="h3produtos">Soluções inteligentes para o seu dia-a-dia.</h3>
        <div class="flexprodutos">
            <div class="itensprodutos">
                <img src="../imagens/grafico.svg" alt="internet icone">
                <h2>Activtrak</h2>
                <p>A melhor forma de otimizar a produtividade da sua equipe.
                    Faça um Teste!</p>
                <a href="#">Saiba Mais</a>
            </div>

        </div>
    </main>
    <footer>
        <div class="foot">
            <picture>
                <img src="../imagens/logo-hdr3.png" alt="">
            </picture>
            <div>
                <ul class="contato">
                    <li><a href="#">- Fale conosco -</a></li>
                    <li><a href="../cadastro.html">- Cadastre-se -</a></li>
                </ul>
                <ul class="contato outros">
                    <li><a href="#">- Manual dos Telefones - </a></li>
                    <li><a href="#">- Prestação STFC -</a></li>
                    <li><a href="#">- Prestação SMP -</a></li>
                    <li><a href="#">- Cobertura SMP -</a></li>
                    <li><a href="#"> - Adesão e prestação do SCM BL -</a></li>
                    <li><a href="#">- Adesão e prestação do SCM IP -</a></li>
                </ul>
            </div>
        </div>
        <div class="fechamento">
            <p>Copyright © 2022 Telecall. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>