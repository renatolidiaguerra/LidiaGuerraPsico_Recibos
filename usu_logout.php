<?php
session_start();

include('i_print.php');
include('i_controla_cookie.php');
include('i_controla_sessao.php');

$mensagem = "";

if (isset($_GET['retorno'])) {
	$mensagem = "Usuario ou senha invalida";
	exibe("usuario invalido");
}

	if (existe_cookie()) {
		cria_sessao($_COOKIE['usuario']);
		exibe("Criando sessao cookie:".$_COOKIE['usuario']);
	}

?>

<!DOCTYPE html>
<html>
<title>Emissor de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<body>
	<div id="header_pagina">
	  <h1>Logout</h1>
	</div>
	
	<form>
	
		<div id="botao_e">
			Deseja mesmo sair do sistema?
		</div> 
		<br>
		<a  id="botao_ok"
			href='usu_logout_f.php'>

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">warning</i>
			Logoff
		</a>
	
	</form> 

	<a 	id="botao_voltar"
		href="aju.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>


</body>
