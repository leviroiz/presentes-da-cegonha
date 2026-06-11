
<!DOCTYPE php>
  <php lang="pt-br">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <!-- LINK CSS -->
      <link rel="stylesheet" href="./css/index.css">

       <!-- LINK JAVA -->
      <script src="./cegonha.js"></script>
      <script src="./alljs/script.js"></script>
      <script src="./alljs/jquery.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    
      <title>Tela Principal</title>
    </head>
<body>
  <header>

    <!-- NAVBAR -->
    <nav class="navbar" style="position: absolute;">

      <a href="" data-target="slide-out" class="sidenav-trigger" >
        <i class="material-icons">menu</i>
      </a>
     
        <div class="nav-wrapper container">

            <!-- LOGO -->
            <div class="brand-logo" >
                <img src="./img/logosite.png"class="logo">
            </div>

            <form class="left hide-on-med-and-down" style="margin-left: 100px;" >
              <div class="input-field">
                <input id="search" type="search" placeholder="O que você proucura?" required style="font-size: 19px; margin-left: 10px; margin-top: 21px; width: 490px; height: 80px">
                <label class="label-icon" for="search" style="margin-left: 5px; margin-top: 10px;"><i class="large material-icons" style="font-size: 27px;">search</i></label>
                <i class="medium material-icons" style="margin-top: 10px; font-size: 27px;">close</i>
              </div>
            </form>

            <!-- MENU DESKTPOP -->
            <ul class="right hide-on-med-and-down" id="menu-desk" style="margin-top: 30px; margin-right: 155px; position: relative">
                <li><a href="index.php" style="margin-right: 10px; font-size: 18px; font-family: 'Rubik', sans-serif;">Home</a></li>
                <li><a href="./tela_sobre.php" style="margin-right:10px; font-size:18; font-family: 'Rubik', sans-serif;">Sobre</a></li>
                <li><a href="login.php" style="font-size:18; font-family: 'Rubik', sans-serif;">Login</a></li>
                <li><a href="./cadastro_cliente.php" style="margin-right:10px; font-size:18; font-family: 'Rubik', sans-serif;">Cadastrar</a></li>
            </ul>

            <a id="carrin" href="./carrinho.php"><img id="carrinho" src="./icons/carrinho.png"><img id="seta" src="./icons/seta.png"></a>
            <a href="./carrinho.php" class="carrin">Carrinho</a>
            

            <!-- MENU MOBILE --> 
            <ul class="sidenav" id="slide-out">
              <div class="input-field" style="height: auto;" >
                <input id="search" type="search" placeholder="O que você proucura?" required style="width: 490px;">
                <label class="label-icon" for="search" style="margin-top: 6.5px;"><i class="material-icons">search</i></label>
                <i class="material-icons" style="margin-top: 6.5px;">close</i>
              </div>



                <li><a href="index.php">Home</a></li>
                <li><a href="./paychecked.php">Sobre</a></li>
                <li><a href="./login.php">Login</a></li>
                <li><a href="./cadastrar_produto.php">Cadastro</a></li>
                
            </ul>
        </div>
    </nav>
  </header>
    
    <!-- Carousel -->
    <div class="carousel carousel-slider" style="margin-top: 120px">
      <a class="carousel-item" ><img src="./img/babyBanner.png" height="750px"></a>
      <a class="carousel-item" ><img src="./img/pinkBanner.png" height="750px"></a>
      <a class="carousel-item" ><img src="./img/freteBanner.png" height="750px"></a>

    </div>

    <!-- GRID -->
    <div class="row">
      <div class="col s12 16 push-13">
        <h1 class="font-effect-outline" id="confira">Confira algumas de nossas ofertas!</h1>
      </div>
      
    </div>


   <!-- CARDS PRODUTOS -->
   <div id="org2" class="row container">
    
   <!-- PRODUTO 1 -->
    <div id="produto2" class="card 1">
      <div id="borda" class="col s12 m7 14">

        <div class="card-image">
          <img id="orgimg" src="./produtos/kit3meias.webp" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Sandália Femenina</span>
          <p>$ 69.99</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 2 -->
    <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">

        <div class="card-image">
          <img src="./produtos/kit3meiasf.webp" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Kit 3 Meias Meninas</span>
          <p>$ 29.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>  

    <!-- PRODUTO 3 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/sapato_baby_feminino.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Kit 3 Meias Meninos</span>
          <p id="preços">$ 29.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 4 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/urso1.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Urso de Pelucía</span>
          <p id="preços">$ 69.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>
   </div>

    <div id="org2" class="row container">

    <!-- PRODUTO 5 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/mamadeira.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Mamadeira Desgastada</span>
          <p id="preços">$ 9.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 6 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/carrinhodebebe.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Carrinho de bebê</span>
          <p id="preços">$ 99.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 7 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/camisaF.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Camisa de Menina</span>
          <p id="preços">$ 29.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 8 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/urso2.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Urso de Pelucía</span>
          <p id="preços">$ 69.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>
    </div>

    <div id="org2" class="row container">

    <!-- PRODUTO 9 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/camisaM.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Camiseta de Menino</span>
          <p id="preços">$ 29.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 10 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/berco.jpg" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Berço tamanho Médio</span>
          <p id="preços">$ 109.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 11 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/sapato_baby_feminino.png" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Sapatinho Feminino</span>
          <p id="preços">$ 49.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>

    <!-- PRODUTO 12 -->
   <div id="produto2" class="card 2">
      <div id="borda" class="col s12 m7 14">
   <div class="card-image">
          <img src="./produtos/mamadeiramenina.png" alt="" class="responsive-img materialboxed" style="height: 200px; width: 200px;"> 
        </div>

        <div class="card-content">
          <span class="card-title">Mamadeira Rosa</span>
          <p id="preços">$ 29.90</p>
        </div>

        <div class="card-content">
          <a href="./login.php" class="btn indigo lighten-3">Comprar</a>
        </div>
      </div>
    </div>
    </div>
    
    <!-- Footer -->
    <footer class="page-footer">

      <div id="boxfooter">
    <h1 id="loja">Loja física <br> no Monsenhor</h1>
    <div id="linha"></div>
    <p id="desc">segunda a sexta das 8h as 18h <br>Sábado das 9h as 13h</p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="dark-text" style="font-weight: bold;">Contatos</h5>

            <div id="instagrã">
            <p style="margin-top: 0px;" class="dark-text text-lighten-4"><img src="./icons/insta.png" width="35px"></p>
            <p style="margin-top: 5px; margin-left: 5px;">@presentesdacegonha</p>
            </div>

            <div id="facebuk">
            <p style="margin-top: 0px;" class="dark-text text-lighten-4"><img src="./icons/face.png" width="45px"></p>
            <p style="margin-top: 10px; margin-left: 5px;">presentedacegonha</p>
            </div>
          </div>

            <br>
            <div id="e-mail">
            <p style="margin-top: 0px;" class="dark-text text-lighten-4"><img src="./icons/email.png" width="40px"></p>
            <p style="margin-top: 10px; margin-left: 5px;">presentesdacegonha@gmail.com</p>
            </div>

            <div id="telefone">
            <p style="margin-bottom: 10px;" class="dark-text text-lighten-4"><img src="./icons/telefone.png" width="35px"></p>
            <p style="margin-top: 5px; margin-left: 5px;">(88) 99905-9946</p>
            </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container" id="copyright">
        © 2014 Copyright Text
        <a class="4 right" href="#!">More Links</a>
        </div>
      </div>
    </footer>

    <section></section>
<a href="#" class="bnt"></a>

  <!--JavaScript at end of body f or optimized loading-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
<script src="./cegonha.js"></script>
</body>
  </php>