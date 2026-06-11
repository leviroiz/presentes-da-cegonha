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

      <link rel="stylesheet" href="./css/alterar_cliente.css">
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
        <form id="login_form" action="alterar_clientebd.php" method="POST">
        <?php 
            $idAlt = $_GET['id'];
            $sql = "SELECT *FROM tb_cliente WHERE id_cliente = '$idAlt';";
            $query = mysqli_query($conn , $sql);
                if($query){
                    while($row = mysqli_fetch_array($query , MYSQLI_ASSOC)){
        
            ?>

            <div id="form_header">
                <h1 style="font-size: 50px;">Alterar Cliente</h1>
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

            <!-- Id -->
                <label for="nome">
                        Id
                        <div id="home" class="input-field">
                        <input type="text" name="id_cliente" id="id_cliente" readonly="true" value="<?php echo $idAlt;?>">
                            <i class=""></i>
                        </div>
                    </label>
                
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
                        Telefone
                        <div id="tel" class="input-field">
                        <input type="text" name="telefone" id="telefone" value="<?php echo $row['telefone']?>">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                </div>
                </div>

                <div class="emaildate">

                <!-- E-mail -->

                    <label for="nome">
                        E-mail
                        <div id="email" class="input-field">
                        <input type="text" name="email" id="email" value="<?php echo $row['email'];?>">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Data de Nascimento -->

                    <label for="nome">
                        Senha
                        <div id="data" class="input-field">
                        <input type="text" name="senha" id="senha" value="<?php echo $row['senha']?>">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                </div>
                </div>

                <div class="cepf">
                    <!-- CPF -->
                
                    <label for="nome">
                        CPF
                        <div id="cpf" class="input-field">
                        <input type="text" name="cpf" id="cpf" readonly="true" value="<?php echo $row['cpf'];?>">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- CEP -->
                
                    <label for="nome">
                        CEP
                        <div id="cep" class="input-field">
                        <input type="text" name="CEP" id="CEP" value="<?php echo $row['CEP'];?>">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                
                <div class="bairrua">

                    <!-- Bairro -->
                
                    <label for="nome">
                        Bairro
                        <div id="bairro" class="input-field">
                        <input type="text" name="bairro" id="bairro" value="<?php echo $row['bairro'];?>">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Rua -->
                
                    <label for="nome">
                        Rua
                        <div id="rua" class="input-field">
                        <input type="text" name="rua" id="rua" value="<?php echo $row['rua'];?>">
                            <i class=""></i>
                        </div>
                    </label>
                </div>

                <div class="resisex">
                    <!-- nº Residência -->
        
                    <label for="nome">
                        nº Residência
                        <div id="home" class="input-field">
                        <input type="text" name="n_residencia" id="n_residencia" value="<?php echo $row['n_residencia'];?>">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Cidade -->
                    <label for="nome">
                        Cidade
                        <div id="city" class="input-field">
                        <input type="text" name="cidade" id="cidade" value="<?php echo $row['cidade'];?>">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- SEXO RADIO -->
                  
                  
                      </div>
                    </label>
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