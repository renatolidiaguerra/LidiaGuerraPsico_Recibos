<?php

// cria variaveis BD
$tipo_conexao = $_SERVER['HTTP_HOST'];
 
if (($tipo_conexao == 'localhost') || ($tipo_conexao == '127.0.0.1')){
	// para uso local
	$user = "root";
	$pass = "";
	$server = "localhost";
} else {
	// para uso local
	$user = "user01";
	$pass = "Gb240820";
	$server = "localhost";
}
$db_name = "cadastro";
$tb_recibos = "recibos";

// cria conexão
$conn_rec = new mysqli($server, $user, $pass, $db_name);
// check conexão
if ($conn_rec->connect_error) {
	die("Erro na conexão: " . $conn_rec->connect_error);
}
?>