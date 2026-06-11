<?php 
require_once 'conexao.php';
$id_cliente = htmlspecialchars($_POST['id_cliente']);
$nome = htmlspecialchars($_POST['nome']);
$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['senha']);
$telefone = htmlspecialchars($_POST['telefone']);
$bairro = htmlspecialchars($_POST['bairro']);
$cidade = htmlspecialchars($_POST['cidade']);
$rua = htmlspecialchars($_POST['rua']);
$n_residencia = htmlspecialchars($_POST['n_residencia']);

$sql = "UPDATE tb_cliente SET nome = '$nome' , email = '$email' , senha = '$senha' , telefone = '$telefone' , 
bairro = '$bairro' , cidade = '$cidade' , rua = '$rua' , n_residencia = '$n_residencia' WHERE id_cliente = '$id_cliente';";
$query = mysqli_query($conn , $sql);

mysqli_close($conn);

echo '<script type="text/javascript">';
	echo 'window.location="listar_user.php"';
	echo '</script>';

?>