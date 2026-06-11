<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- LINK CSS -->
    <link rel="stylesheet" href="./css/cadastro_cliente.css">

    <!-- LINK JAVA -->
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
    
    <title>Cadastro</title>
</head>
<body>   

    <!-- LOGO -->
    <main id="container">
        <div class="img"><img id="cegonha" src="./img/logosite.png"></div>

        <!-- FUNDO LOGIN -->
        <form id="login_form" action="cadastro_clientebd.php" method="POST">

            <!-- FORM HEADER -->
            <div id="form_header">
                <h1 style="font-size: 50px;">Cadastro</h1>
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
                            <input name="nome" type="text" id="nome" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Senha -->
                
                    <label for="nome">
                        Senha
                        <div id="senha" class="input-field">
                            <input name="senha" type="text" id="nome" class="validate">
                            <i class=""></i>
                        </div>
                    </label>


                    <!-- Telefone -->
                
                    <label for="nome">
                        Telefone
                        <div id="tel" class="input-field">
                            <input name="telefone" type="text" id="telefone1" class="validate" oninput="this.value = this.value.replace(/[^0-9.-]/g, '')" maxlength="14">
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
                            <input name="email" type="email" id="email" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Data de Nascimento -->

                    <label for="nome">
                        Data de Nascimento
                        <div id="data" class="input-field">
                            <input name="data_nascimento" type="date" id="data_nascimento" class="validate">
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
                            <input type="text" id="cpf1" name="cpf" class="validate" oninput="this.value = this.value.replace(/[^0-9.-]/g, '')" maxlength="14">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- CEP -->
                
                    <label for="nome">
                        CEP
                        <div id="cep" class="input-field">
                            <input name="CEP" type="text" id="CEP" class="validate">
                            <i class=""></i>
                        </div>
                    </label>
                </div>
                
                <div class="bairrua">

                <!-- Cidade -->
                
                <label for="nome">
                        Cidade
                        <div id="cpf" class="input-field">
                            <input name="cidade" type="text" id="nome" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Bairro -->
                
                    <label for="nome">
                        Bairro
                        <div id="bairro" class="input-field">
                            <input name="bairro" type="text" id="bairro" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- Rua -->
                
                    <label for="nome">
                        Rua
                        <div id="rua" class="input-field">
                            <input name="rua" type="text" id="rua" class="validate">
                            <i class=""></i>
                        </div>
                    </label>
                </div>

                <div class="resisex">
                    <!-- nº Residência -->
        
                    <label for="nome">
                        nº Residência
                        <div id="home" class="input-field">
                            <input name="n_residencia" type="text" id="nº_residência" class="validate">
                            <i class=""></i>
                        </div>
                    </label>

                    <!-- SEXO RADIO -->
                  
                    <label>
                        Gênero
                        <div id="sex" class="input-fieldrad">
                      <input class="chk" name="sexo" type="radio" value="Masculino" />
                      <span style="margin-right: 15px;">Masculino</span>
                  

                  
                    
                      <input class="chk" name="sexo" type="radio" value="Feminino"  />
                      <span style="margin-right: 15px;">Feminino</span>
                  

                  
                    
                      <input class="chk" name="sexo" type="radio" value="Outro"  />
                      <span style="margin-right: 15px;">Outro</span>
                      </div>
                    </label>
                </div>

            <!-- LOGIN BUTTON -->
            <button type="submit" id="login_button">
                Cadastrar
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
</body>
</html>
  </php>