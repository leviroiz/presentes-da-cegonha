<?php 
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'bd_cegonha';

// recebe uma conexão com o bqnco de dados
$conn = new mysqli($hostname , $username , $password , $database);

//verifica se a conexão com o banco de dados possui algum erro
    if($conn -> connect_errno){
        die('ERRO AO CONECTAR COM O BANCO DE DADOS');
    }
?>