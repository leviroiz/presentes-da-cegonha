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

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>Produtos</title>
    </head>
    <body>
        <h1 id="agaum">Lista de Produtos</h1>

        <div id="tabela">
        <table border="1">
            <thead>
                <th>ID Produto</th>
                <th>ID Administrador</th>
                <th>Data de Cadastro</th>
                <th>Nome do Produto</th>
                <th>Preco</th>
                <th>Estoque</th>
                <th>Categoria</th>
                <th>Alterar Produto</th>
                <th>Deletar Produto</th>
            </thead>
        </div>
                <?php $sql = "SELECT *FROM tb_produtos; ";
    $query = mysqli_query($conn , $sql);
        if($query){
            while($row = mysqli_fetch_array($query , MYSQLI_ASSOC)){?>
            <tbody>
                <tr>
                    <td><?php echo $row['id_produto'];?></td>

                    <td><?php echo $row['id_admin_cadastro'];?></td>

                    <td><?php echo $row['data_cadastro'];?></td>

                    <td><?php echo $row['nome'];?></td>

                    <td><?php echo $row['preco'];?></td>

                    <td><?php echo $row['estoque'];?></td>

                    <td><?php echo $row['categoria'];?></td>

                    <td>
                        <button><a href="alterar_produto.php?id=<?php echo $row['id_produto'];?>">Alterar</a></button>
                    </td>

                    <td>
                        <button><a onclick="return confirm('Deseja deletar o produto?');" href="deletar_produto.php?id=<?php echo $row['id_produto'];?>">Deletar</a></button>
                    </td>
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