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
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" href="listar_user.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>Usuários</title>
    </head>
    <body>
        <h1 id="agaum">Lista de Usuários</h1>

        <div id="tabela">
        <table border="1">
            <thead>
                <th>ID Usuário</th>
                <th>Data de Cadastro</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Telefone</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Rua</th>
                <th>N° Residência</th>
                <th>CEP</th>
                <th>Sexo</th>
                <th>Alterar</th>
                <th>Deletar</th>
                
            </thead>
            </div>
                <?php $sql = "SELECT *FROM tb_cliente; ";
    $query = mysqli_query($conn , $sql);
        if($query){
            while($row = mysqli_fetch_array($query , MYSQLI_ASSOC)){?>
            <tbody>
                <tr>
                    <td><?php echo $row['id_cliente'];?></td>

                    <td><?php echo $row['data_cadastro'];?></td>

                    <td><?php echo $row['nome'];?></td>

                    <td><?php echo $row['cpf'];?></td>

                    <td><?php echo $row['data_nascimento'];?></td>

                    <td><?php echo $row['email'];?></td>

                    <td><?php echo $row['senha'];?></td>

                    <td><?php echo $row['telefone'];?></td>

                    <td><?php echo $row['bairro'];?></td>

                    <td><?php echo $row['cidade'];?></td>

                    <td><?php echo $row['rua'];?></td>

                    <td><?php echo $row['n_residencia'];?></td>

                    <td><?php echo $row['CEP'];?></td>

                    <td><?php echo $row['sexo'];?></td>

                    <td><button><a href="alterar_cliente.php?id=<?php echo $row['id_cliente']?>">Alterar</a></button></td>

                    <td><button><a onclick="return confirm('Deseja Realmente deletar o usário?')" href="deletar_user.php?id=<?php echo $row['id_cliente'];?>">Deletar</a></button></td>


                    
                </tr>
                    <?php 
                    }
                }?>
            </tbody>
        </table>
        
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>