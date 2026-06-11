<?php 
require_once 'conexao.php';
session_start();

$id_admin_cadastro = $_SESSION['id_admin'];
$nome = htmlspecialchars($_POST['nome']);
$preco = htmlspecialchars($_POST['preco']);
$estoque = htmlspecialchars($_POST['estoque']);
$categoria = htmlspecialchars($_POST['categoria']);

$sql = "INSERT INTO tb_produtos VALUES(DEFAULT , '$id_admin_cadastro' ,DEFAULT, '$nome' , '$preco' , '$estoque' , '$categoria')";
$query = mysqli_query($conn , $sql);

if(!$query){
    echo '<script type="text/javascript">
    alert("Erro ao Cadastrar");
    </script>';
}else{
echo '<script type="text/javascript">
alert("Produto Cadastrado com Sucesso!");   
</script>';
echo '<script type="text/javascript">
window.location = "./listar_produtos.php";
</script>';
}

?>