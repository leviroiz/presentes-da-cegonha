<?php 
require_once 'conexao.php';

//VARIAVEIS INPUTS
$nome = htmlspecialchars($_POST['nome']);
$cpf = htmlspecialchars($_POST['cpf']);
$data_nascimento = htmlspecialchars($_POST['data_nascimento']);
$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['senha']);
$telefone = htmlspecialchars($_POST['telefone']);
$bairro = htmlspecialchars($_POST['bairro']);
$cidade = htmlspecialchars($_POST['cidade']);
$rua = htmlspecialchars($_POST['rua']);
$n_residencia = htmlspecialchars($_POST['n_residencia']);
$CEP = htmlspecialchars($_POST['CEP']);
$sexo = htmlspecialchars($_POST['sexo']);

$sql = "INSERT INTO tb_cliente VALUES( DEFAULT, DEFAULT , '$nome' , '$cpf' , '$data_nascimento' , '$email' , '$senha' , '$telefone' , '$bairro' , '$cidade' , '$rua' , '$n_residencia' , '$CEP' , '$sexo')";
$query = mysqli_query($conn , $sql);

if(!$query){
    echo '<script type="text/javascript">
    alert("Erro ao Cadastrar");
    </script>';
}else{
echo '<script type="text/javascript">
alert("Cadastro Realizado com Sucesso!");   
</script>';
echo '<script type="text/javasscript">
window.location = "./login.php";
</script>';
}

?>