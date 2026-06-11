<?php
require_once 'conexao.php';

$id = htmlspecialchars($_GET['id']);

$sql = "DELETE FROM tb_cliente WHERE id_cliente = '$id';";
$query = mysqli_query($conn , $sql);

    if($query){
        echo '<script type=text/javascript>
            alert("Deletado com Sucesso!");
            window.location="listar_user.php";
      </script>';

    }
mysqli_close($conn);

?>