<?php

include ('i_print.php');
include ('i_controla_cookie.php');
include ('i_controla_sessao.php');
include ('i_conecta_usuarios.php');

$login = $_GET['input_login'];
$senha = $_GET['input_senha'];

//* ----------------------
$login_encript = password_hash($login, PASSWORD_DEFAULT);
$senha_encript = password_hash($senha, PASSWORD_DEFAULT);
$login_encript = $login;
$senha_encript = $senha;
//* ----------------------

$sql = "SELECT usuario, senha, cod_user, nome 
		FROM $tb_usuarios
		WHERE usuario = '$login_encript' and
			  senha   = '$senha_encript'";

$result = $conn_usu->query($sql);


if ($result->num_rows == 0) {
	header("location: usu_login.php?mensagem=Usuario ou senha invalido&login=".$login."");
	die();
}

$dado = $result->fetch_array();

$nome = $dado['nome'];
$cod_user = $dado['cod_user'];

exibe("nome:", $nome);

//* cria cookie
cria_cookie($cod_user);

//* cria sessao
cria_sessao($cod_user);

header("location: index.php");
	
	
//* password_verify ( string $password , string $hash ) : boolean
?>