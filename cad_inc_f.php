<?php
session_start();

include("i_conecta_clientes.php");
$cod_user = $_SESSION['usuario'];

// recebe os parametros do html
$cpf 			= $_POST['input_cpf'];
$nome 			= $_POST['input_nome'];
$endereco 		= $_POST['input_endereco'];
$datanascimento = $_POST['input_datanascimento'];
$email 			= $_POST['input_email'];
$telefone		= $_POST['input_telefone'];
$cpf_titular	= $_POST['input_cpf_titular'];

// cria comando para inserir dados
$sql = "INSERT INTO $tb_clientes (cod_user, cpf, nome, endereco, datanascimento, email, telefone, cpf_titular)
					VALUES ('$cod_user','$cpf','$nome','$endereco','$datanascimento','$email','$telefone','$cpf_titular')";

// executa e verifica resultado
if ($conn_cli->query($sql) === TRUE) {
	// fecha banco
	$conn_cli->close();

	header("location: msg_sucesso.php?destino='index.htm'");

} else {
	echo "Erro incluindo:" . $sql . "<br>" . $conn_cli->error;
	// fecha banco
	$conn_cli->close();
}

?>