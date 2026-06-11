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
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" href="tela_admin.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Tela Admin</title>
    </head>
    <body>
      <main id="all">
      <div id="box">
        <h1 class="font-effect-outline" id="titulo">Tela de Administrador</h1>
        <p></p>

        <div id="container">
        <button id="botao">
          <a style="color: #9c91ff;" href="cadastrar_produto.php">Cadastrar Produto</a>
        </button>

        <p></p>

        <button id="botao">
          <a style="color: #9c91ff;" href="listar_produtos.php">Listar Produtos</a>
        </button>

        <p></p>

        <button id="botao"s>
          <a style="color: #9c91ff;" href="listar_user.php">Listar Usuários</a>
        </button>
        </div>
        </div>
        </main>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>