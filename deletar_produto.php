<?php 
require_once 'conexao.php';
$id = htmlspecialchars($_GET['id']);

$sql = "DELETE FROM tb_produtos WHERE id_produto = '$id';";
$query = mysqli_query($conn , $sql);

mysqli_close($conn);

echo '<script type="text/javascript">';
echo 'window.location="listar_produtos.php"';
echo '</script>';
?>