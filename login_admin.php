<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="./css/style.css">
    
    <title>Login JNDL</title>
</head>
<body>   
    <main id="container">
    <div class="img"><img id="cegonha" src="./img/logosite.png"></div>

        <form id="login_form" action="validar_admin.php" method="POST">
            <!-- FORM HEADER -->
            <div id="form_header">
                <h1>Login Admin</h1>
                <!--i id="mode_icon" class="luazinha"><img src="./icons/luazinha.png"></i!-->
                <!--i id="mode_icon" class="material-icons">brightness_2</i!-->
                <div class="wrapper">
            <div class="toggle">
                <input class="toggle-input" type="checkbox" id="mode_chk" />
            <div class="toggle-bg"></div>
            <div class="toggle-switch">
            <div class="toggle-switch-figure"></div>
            <div class="toggle-switch-figureAlt"></div>
            </div>  
        </div>
    </div>
            </div>

            <!-- Outras Formas de Login -->
        

            <!-- INPUTS -->
            <div id="inputs">

                <!-- NOME 
                <div class="input-box">
                    <label for="name">
                        Nome
                        <div class="input-field">
                            <input type="text" id="name" name="nome">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </label>
                </div>
                -->
                <!-- EMAIL -->
                <div class="input-box">
                    <label for="login">
                        Login
                        <div class="input-field">
                            <input type="text" id="login" name="login">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </label>
                </div>
                
                <!-- SENHA -->
                <div class="input-box">
                    <label for="password">
                        Senha
                        <div class="input-field">
                            <input type="password" id="password" name="senha">
                            <i class="fa-solid fa-key"></i>
                        </div>
                    </label>
                    
                    <!-- FORGOT PASSWORD -->
                    <div id="forgot_password">
                        <a href="#">
                            Esqueceu sua senha?
                            <p></p>
                        </a>
                        <a href="cadastro_cliente.php">Não possui uma conta?</a>
                    </div>
                </div>
            </div>

            <!-- LOGIN BUTTON -->
            <button type="submit" id="login_button">
                Login
            </button>
        </form>
    </main>

    <!-- JAVASCRIPT -->
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>