<?php
    require_once 'conexao.php';

    session_start();

    if(!isset ($_SESSION['id_admin']) ) {
        echo '
            <script type = "text/javascript">
            alert( "Você precisa fazer o login para acessar esta página!");
            window.location = "../index.php"
            </script>
            ';
    }
?>
<!DOCTYPE html>
  <html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <link rel="stylesheet" href="./css/cadastrar_produto.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <title>Cadastrar Produto</title>
    <body>

      <!-- LOGO -->
    <main id="container">
        <div class="img"><img id="cegonha" src="./img/logosite.png"></div>

        <!-- FUNDO LOGIN -->
        <form id="login_form" action="cadastrar_produtobd.php" method="POST">

            <div id="form_header">
                <h1 style="font-size: 50px;">Cadastrar Produto</h1>
                <!--i id="mode_icon" class="luazinha"><img src="./icons/luazinha.png"></i!-->
                <!--i id="mode_icon" class="material-icons">brightness_2</i!-->
                
                <!-- ÍCONES -->
                <div class="wrapper">
            <div class="toggle">
                <input class="toggle-input" type="checkbox" id="mode_chk"/>
            <div class="toggle-bg"></div>
            <div class="toggle-switch">
            <div class="toggle-switch-figure"></div>
            <div class="toggle-switch-figureAlt"></div>
            </div>  
        </div>
    </div>
            </div>

    <!-- INPUTS -->
    <div class="nometel">
                
                <!-- Nome -->
                
                <label for="nome">
                        Nome
                        <div id="name" class="input-field">
                        <input type="text" name="nome">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Telefone -->
                
                    <label for="ID">
                        Categoria
                        <div id="tel" class="input-field">
                        <input type="text" name="categoria">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                </div>
                </div>

                <div class="emaildate">

                <!-- E-mail -->

                    <label for="nome">
                        Preço
                        <div id="email" class="input-field">
                        <input type="number" name="preco">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Data de Nascimento -->

                    <label for="nome">
                        Estoque
                        <div id="data" class="input-field">
                        <input type="number" name="estoque">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                </div>
                </div>

                <button type="submit" id="login_button" value="Enviar">
                Enviar
            </button>
        
        </div>
        
      </form>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="./js/script.js"></script>
    </body>
  </html>