
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
      <link rel="stylesheet" href="./allcss/styles.css">
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/carrinho.css">

      <!-- LINK JAVA  -->
      <script src="./alljs/script.js"></script>
      <script src="./js/cegonha.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    
      <title>Meu Carrinho</title>
    </head>
<body>
  
  <header>

    <!-- NAVBAR  -->
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
      <div class="content">
        <section id="all">
          <table>

          <!-- HEAD CARRINHO --> 
            <thead>
              <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>-</th>
              </tr>
            </thead>
            <tbody>

              <!-- PRODUTO 1 --> 
              <tr>
                <td>
                  <div class="product">
                    <img src="https://picsum.photos/100/120" alt="" />
                    <div class="info">
                      <div class="name">Nome do produto</div>
                      <div class="category">Categoria</div>
                    </div>
                  </div>
                </td>
                <td>R$ 120</td>
                <td>
                  <div class="qty">
                    <button id="botao"><i style="margin-right: 20px;" class="bx bx-plus"></i></button>
                    <span id="number" style="z-index: 1; position: absolute; margin-left: 35px; margin-bottom: 5px; background-color: f0f0f0; padding: 10.5px">2</span>
                    <button id="botao2"><i style="margin-left: 25px;" class="bx bx-minus"></i></button>
                  </div>
                </td>
                <td>R$ 240</td>
                <td>
                <i id="close" class="medium material-icons" style="margin-top: 10px; font-size: 27px;">close</i>
                </td>
              </tr>

              <!-- PRODUTO 2 --> 
              <tr>
                <td>
                  <div class="product">
                    <img src="https://picsum.photos/100/120" alt="" />
                    <div class="info">
                      <div class="name">Nome do produto</div>
                      <div class="category">Categoria</div>
                    </div>
                  </div>
                </td>
                <td>R$ 120</td>
                <td>
                  <div class="qty">
                  <button id="botao"><i style="margin-right: 20px;" class="bx bx-plus"></i></button>
                    <span id="number" style="z-index: 1; position: absolute; margin-left: 35px; margin-bottom: 5px; background-color: f0f0f0; padding: 10.5px">2</span>
                    <button id="botao2"><i style="margin-left: 25px;" class="bx bx-minus"></i></button>
                  </div>
                </td>
                <td>R$ 240</td>
                <td>
                <i id="close" class="medium material-icons" style="margin-top: 10px; font-size: 27px;">close</i>
                </td>
              </tr>

              <!-- PRODUTO 3 --> 
              <tr>
                <td>
                  <div class="product">
                    <img src="https://picsum.photos/100/120" alt="" />
                    <div class="info">
                      <div class="name">Nome do produto</div>
                      <div class="category">Categoria</div>
                    </div>
                  </div>
                </td>
                <td>R$ 120</td>
                <td>
                  <div class="qty">
                  <button id="botao"><i style="margin-right: 20px;" class="bx bx-plus"></i></button>
                    <span id="number" style="z-index: 1; position: absolute; margin-left: 35px; margin-bottom: 5px; background-color: f0f0f0; padding: 10.5px">2</span>
                    <button id="botao2"><i style="margin-left: 25px;" class="bx bx-minus"></i></button>
                  </div>
                </td>
                <td>R$ 240</td>
                <td>
                <i id="close"  class="medium material-icons" style="margin-top: 10px; font-size: 27px;">close</i>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <aside>

        <!-- CAIXA --> 
          <div class="box">
            <div class="boxresumo">
            <header style="font-size: 21px; font-weight: bold; margin-bottom: 15px;">Resumo do Pedido</header>
            </div>
            <div class="info">
              <footer id="subtotal">
              <span style="font-size: 15px; margin-bottom: 5px;">Subtotal</span>
              <span style="font-size: 15px;"> R$ 418</span>
              </footer>
              <div style="display: flex; justify-content: space-between; margin-right: 25px;"><span style="font-size: 16px; margin-left: 5px;">Frete</span><span> Grátis</span></div>
              <div>
                <button style="margin-top: 5px; margin-bottom: 10px;" onclick="funcao1()" value="Exibir Alert" id="discontu">
                  Adicionar cupom de desconto
                  <i class="bx bx-right-arrow-alt"></i>
                </button>
              </div>
            </div>
            <footer id="total">
              <span style="font-size: 16px;">Total</span>
              <span style="font-size: 16px;">R$ 418</span>
            </footer>
            <button id="finalized">Finalizar Compra</button>
          </div>
        </aside>
      </div>
    </main>

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
            <p style="margin-bottom: 0px;" class="dark-text text-lighten-4"><img src="./icons/telefone.png" width="35px"></p>
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
  <script>
function funcao1()
{
alert("Você não tem cupons disponíveis para este pedido!");
}
</script>
</body>
  </php>