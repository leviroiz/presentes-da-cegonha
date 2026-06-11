<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- LINK CSS -->
    <link rel="stylesheet" href="./tela_pagamento.css">

    <!-- LINK JAVA -->
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
    
    <title>Cadastro</title>
</head>
<body>   

    <!-- LOGO -->
    <main id="container">
        <div class="img"><img id="cegonha" src="./img/logosite.png"></div>

        <!-- FUNDO LOGIN -->
        <form id="login_form" action="./pagamentobd.php" method="POST">

            <!-- FORM HEADER -->
            <div id="form_header">
                <h1 style="font-size: 50px;">Pagamento</h1>
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
    <body>
      <!-- INPUTS -->
                    <!-- CEP -->
                <div id="ceprua">
                    <label for="nome">
                        CEP
                        <div id="cep" class="input-field">
                        <input type="text" name="cep" id="cep" class="validate">
                            <i class=""></i>
                        </div>
                    </label>
                
                <label for="nome">
                        Valor
                        <div id="valor" class="input-field">
                        <input type="text" name="valor" id="valor" class="validate">
                            <i class=""></i>
                        </div>
                        </div>

                <div class="bairrua">

                <!-- Cidade -->
                
                <label for="nome">
                        Cidade
                        <div id="cpf" class="input-field">
                        <input type="text" name="cidade" id="cidade" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Bairro -->
                
                    <label for="nome">
                        Bairro
                        <div id="bairro" class="input-field">
                        <input type="text" name="bairro" id="bairro" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Rua -->
                </div>

                <label for="nome">
                        Rua
                        <div id="rua" class="input-field">
                        <input type="text" name="rua" id="rua" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                <div class="resisex">
                    <!-- nº Residência -->
        
                    <label for="nome">
                        nº Residência
                        <div id="home" class="input-field">
                        <input type="text" name="n_residencia" id="n_residencia" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- SEXO RADIO -->
                  
                    <label>
                        Métodos de pagamento:
                        <div id="sex" class="input-fieldrad">
                        <input type="radio" name="tipo_pagamento" id="tipo_pagamento" value="Cartão de Crédito">
                      <span style="margin-right: 15px;">Cartão</span>
                  

                  
                    
                      <input type="radio" name="tipo_pagamento" id="tipo_pagamento" value="Dinheiro">
                      <span style="margin-right: 15px;">Dinheiro</span>
                  

                  
                    
                      <input type="radio" name="tipo_pagamento" id="tipo_pagamento" value="Pix">
                      <span style="margin-right: 15px;">Pix</span>
                      </div>

                    </label>
                </div>
    
            <!-- CONFIRMAR BUTTON -->
            <button  id="login_button" type="submit" value="Confirmar Compra" onclick="return confirm('Deseja efetuar o pagamento?');">
                Confirmar
            </button>
        </form>
    </main>
    <script src="./js/script.js"></script>

  <!--JavaScript at end of body f or optimized loading-->
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <script type="text/javascript">  
 const input = document.querySelector('#cpf1')
  input.addEventListener('keypress', ()=> {
    let inputlength = input.value.length

    console.log(inputlength)
    if(inputlength === 3 || inputlength === 7){
      input.value += '.'
    }else if(inputlength === 11){
      input.value += '-'
    }
  });
  
  const inputt = document.querySelector('#telefone1')
  inputt.addEventListener('keypress', ()=> {
    let inputlength = inputt.value.length

    console.log(inputtlength)
    if(inputlength === 3 || inputlength === 7){
      input.value += '.'
    }else if(inputlength === 11){
      input.value += '-'
    }
  });   

</script>
<script src="./script.js"></script>
        </form>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
        