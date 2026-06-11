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
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <link rel="stylesheet" href="alterar_produto.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>Alterar</title>
    </head>
    <body>

    <!-- LOGO -->
    <main id="container">
        <div class="img"><img id="cegonha" src="./img/logosite.png"></div>

        <!-- FUNDO LOGIN -->
        <form id="login_form" action="alterar_produtobd.php" method="POST">
        <?php 
            $idAlt = $_GET['id'];
            $sql = "SELECT *FROM tb_produtos WHERE id_produto = '$idAlt';";
            $query = mysqli_query($conn , $sql);
                if($query){
                    while($row = mysqli_fetch_array($query , MYSQLI_ASSOC)){
        
            ?>

            <div id="form_header">
                <h1 style="font-size: 50px;">Alterar Produto</h1>
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
                        <input type="text" name="nome" id="nome" value="<?php echo $row['nome'];?>"> 
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Telefone -->
                
                    <label for="ID">
                        Id
                        <div id="tel" class="input-field">
                        <input type="text" name="id_produto" id="id_produto" readonly="true" value="<?php echo $idAlt;?>">
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
                        <input type="number" name="preco" id="preco" value="<?php echo $row['preco'];?>">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Data de Nascimento -->

                    <label for="nome">
                        Estoque
                        <div id="data" class="input-field">
                        <input type="number" name="estoque" id="estoque" value="<?php echo $row['estoque'];?>">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                </div>
                </div>

                <button type="submit" id="login_button" value="Enviar">
                Enviar
            </button>
            <?php 
            }
        }
        ?>
         </form>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script src="./script.js"></script>
      
    </body>
  </html>