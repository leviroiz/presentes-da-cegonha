<?php 
require_once 'conexao.php';
session_start();



$id_cliente = $_SESSION['id_cliente'];
$cep = htmlspecialchars($_POST['cep']);
$cidade = htmlspecialchars($_POST['cidade']);
$bairro = htmlspecialchars($_POST['bairro']);
$rua = htmlspecialchars($_POST['rua']);
$n_residencia = htmlspecialchars($_POST['n_residencia']);
$tipo_pagamento = htmlspecialchars($_POST['tipo_pagamento']);
$valor = htmlspecialchars($_POST['valor']);

$sql = "INSERT INTO tb_realiza_pagamento VALUES (DEFAULT , DEFAULT , DEFAULT , DEFAULT, '$cep' , '$cidade' , '$bairro' , '$rua' , '$n_residencia', DEFAULT , '$valor')";
$query = mysqli_query($conn , $sql);

if(!$query){
    echo '<script type="text/javascript">
    alert("Erro ao Efetuar o Pagamento");
    </script>';
}else{
echo '<script type="text/javascript">
alert("Pagamento Realizado com sucesso!");   
window.location = "paychecked.php";
</script>';
}

?>