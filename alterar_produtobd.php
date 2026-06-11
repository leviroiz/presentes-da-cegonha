<?php 
require_once 'conexao.php';
        $id_produto = htmlspecialchars($_POST['id_produto']);
        $nome = htmlspecialchars($_POST['nome']);
        $preco = htmlspecialchars($_POST['preco']);
        $estoque = htmlspecialchars($_POST['estoque']);

$sql = "UPDATE tb_produtos SET nome = '$nome' , preco = '$preco' , estoque = '$estoque' WHERE id_produto = '$id_produto';";
$query = mysqli_query($conn , $sql);

mysqli_close($conn);

echo '<script type="text/javascript">';
	echo 'window.location="listar_produtos.php"';
	echo '</script>';

?>