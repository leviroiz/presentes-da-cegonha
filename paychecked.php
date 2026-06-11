
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
      <link rel="stylesheet" href="./paychecked.css">

       <!--JQuery  -->
      <script src="./js/cegonha.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
      crossorigin="anonymous"></script>
    
      <title>Parabéns!</title>
    </head>
<body>
  
  <header>
    <!-- NAVBAR -->
    <nav class="navbar">

      <a href="" data-target="slide-out" class="sidenav-trigger">
        <i class="material-icons">menu</i>
      </a>
     
        <div class="nav-wrapper container">

            <!-- LOGO -->
            <div class="brand-logo">
                <img src="./img/logosite.png"class="logo" >
            </div>

            <!-- MENU DESKTPOP -->
            <ul class="right hide-on-med-and-down" id="menu-desk" style="margin-top: 30px; margin-right: 155px; position: relative">
                <li><a href="index.php" style="margin-right: 10px; font-size: 18px; font-family: 'Rubik', sans-serif;">Home</a></li>
                <li><a href="./paychecked.php" style="margin-right:10px; font-size:18; font-family: 'Rubik', sans-serif;">Sobre</a></li>
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
                <li><a href="">Sobre</a></li>
                <li><a href="">Contatos</a></li>
                <li><a href="login.php">Login</a></li>
                
            </ul>
        </div>
    </nav>
  </header>

    <main>
      <!-- MEIO DA TELA -->
      <h1 class="h1"><img src="./icons/checkmofi.png" id="h1img"><br>Compra Finalizada!</h1>
      <p id="parágrafo">Parabéns! Seu pagamento foi realizado com sucesso e sua compra já foi efetuada.
       Sua encomenda <br> será enviada e chegará em breve em sua residência.</p>
      </h1> 
    </main>

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
            <p style="margin-top: 20px; margin-left: 5px;">(88) 99905-9946</p>
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

  <!--JavaScript at end of body f or optimized loading-->
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!--LINK JAVA -->
  <script src="./alljs/script.js"></script>
</body>
  </php>