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
  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
  <title>Telecall - Soluções completas em telefonia e internet</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <!--modo escuro-->
  <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
</head>

<body>
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
                <a class="nav-link active" id="cliente" aria-current="page" href="paginas/telelog.php">Area do
                  Cliente</a>
              </ul>

            </div>
          </ul>

        </div>
        <!--modo escuro-->
       <!--  <div>
          <input type="checkbox" class="checkbox" id="darkmode" />

          <label class="label" for="darkmode">
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
        <a class="navbar-brand" href="#"><img class= "img"src="imagens/logo-hdr.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04"
          aria-controls="navbarsExample04" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarsExample04">
          <ul class="navbar-nav me-auto mb-2 mb-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link  active " href="paginas/produtos.php#pinternet" aria-expanded="false">Internet</a>

            </li>
            <li class="nav-item dropdown">
              <a class="nav-link  active" href="paginas/produtos.php#ptelefonia" aria-expanded="false">Telefonia</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link  active" href="paginas/produtos.php#prede" aria-expanded="false">Redes e
                Infraestrutura</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link  active" href="paginas/produtos.php#pmobilidade" aria-expanded="false">Mobilidade</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link  active" href="paginas/produtos.php#peventos" aria-expanded="false">Eventos</a>
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
      if ($logado){
        echo"
        <div class='fr'>
          <a href='paginas/telelog.php'><img class='imgloginHeader'src='imagens/iconlogin.jpg' alt='User' ></a>
          <div>             
            <p class='nomeLog'> $nome </p>            
            <a class ='nomeLog' href='paginas/logout.php'>Logout</a>  
          </div>
        </div>
        
        ";
      }
    ?>
  </header>
  <main>
    <!-- carrossel-->
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3000">
          <img src="imagens/banner-desk-dudu.png" class="d-block w-100 rounded" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
          <img src="imagens/bannercart.png" class="d-block w-100 rounded" alt="...">
        </div>
        <div class="carousel-item">
          <img src="imagens/activtrakbanner.png" class="d-block w-100 rounded" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- fim do carrossel-->
    <div class="solucoes">
      <!-- inicio soluções-->
      <h1 class="h1fontg h1solu"> Soluções inteligentes para sua empresa</h1>
      <div class="flex">
        <div class="solucoes-box">
          <img src="imagens/internetpb.png" alt="">
          <h2> Internet</h2>
          <p>Soluções de internet em Fibra com alta qualidade e disponibilidade</p>
          <a href="paginas/produtos.php">Saiba Mais</a>
        </div>
        <div class="solucoes-box">
          <img src="imagens/Telefone.svg" alt="">
          <h2> Telefonia</h2>
          <p>Soluções inteligentes de PABX IP na núvem para sua telefonia fixa.</p>
          <a href="paginas/produtos.php">Saiba Mais</a>
        </div>
        <div class="solucoes-box">
          <img src="imagens/mobilidade.png" alt="">
          <h2>Mobilidade</h2>
          <p>Monte planos de celular personalizados para sua empresa, pague apenas pelo que precisar.</p>
          <a href="paginas/produtos.php">Saiba Mais</a>
        </div>
      </div>
    </div> <!-- Fim da div Soluções-->
    <div class="ecom">
      <!-- e-comerce-->
      <h1 class="h1fontg">Conheça o nosso <br> e-commerce </h1>
      <h2 id="rapido">Rápido, fácil e Self-service</h2>
      <img class="ecom-img" src="imagens/ecomerce.svg" alt="e-comerce">
    </div>
    <div class="mapa">
      <!-- mapa -->
      <img src="imagens/MapaRJ.png" alt="mapa rio de janeiro">
      <div class="infomapa">
        <img src="imagens/imgmapa.png" alt="">
      </div>

    </div>


    <div class="depo">
      <!--Depoimentos-->
      <h1 class="h1fontg">Nossos clientes que acreditam nos nossos serviços.</h1>
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
            aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active mediaqr" data-bs-interval="4000">
            <picture>
              <source media="(min-width: 600px)" srcset="imagens/teste2.png">
              <img src="imagens/teste6.png" class="d-block w-100 rounded" alt="...">
            </picture>
          </div>
          <div class="carousel-item mediaqr" data-bs-interval="4000">
            <picture>
              <source media="(min-width: 600px)" srcset="imagens/maratona3.jpg">
              <img src="imagens/maratona2.jpg" class="d-block w-100 rounded" alt="...">
            </picture>
          </div>
          <div class="carousel-item  mediaqr" data-bs-interval="4000">
            <picture>
              <source media="(min-width: 600px)" srcset="imagens/autralia3.png">
              <img src="imagens/autralia2.png" class="d-block w-100 rounded" alt="...">
            </picture>
          </div>
          <div class="carousel-item mediaqr">
            <picture>
              <source media="(min-width: 600px)" srcset="imagens/skate2.png">
              <img src="imagens/skate.png" class="d-block w-100 rounded" alt="...">
            </picture>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div> <!-- fim div depoimentos -->
    <div class="depoh1">
      <!-- inicio bloco do vídeo -->
      <h1 class="h1fontg">Conheça mais sobre a nossa empresa!</h1>
    </div>
    <div class="video d-flex justify-content-center">
      <iframe class="videoifr" width="560" height="315" src="https://www.youtube.com/embed/4PPjNiyLhZE"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
    </div>
  </main>
  <footer>
    <div class="foot">
      <picture>
        <img src="imagens/logo-hdr3.png" alt="">
      </picture>
      <div>
        <ul class="contato">
          <li><a href="#">- Fale conosco -</a></li>
          <li><a href="cadastro.php">- Cadastre-se -</a></li>
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
  <script type="text/javascript" src="js/scriptDM.js"></script>
</body>

</html>