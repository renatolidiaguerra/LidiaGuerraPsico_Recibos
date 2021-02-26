<?php
session_start();

include('i_print.php');
include('i_controla_cookie.php');
include('i_controla_sessao.php');

$mensagem = "";
$login	  = "";

if (isset($_GET['mensagem'])) {
	$mensagem 	= $_GET['mensagem'];
	$login 		= $_GET['login'];
}

if (existe_sessao()) {
	header ('location: index.php');
} else {
	if (existe_cookie()) {
		cria_sessao($_COOKIE['usuario']);
		exibe("Criando sessao cookie:".$_COOKIE['usuario']);
	}
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
	  <h1>Login</h1>
	</div>

	<form 	name="login" 
			method="GET" 
			action='usu_login_f.php'
			autocomplete="off"		> 
			
	<?php 
	if ($mensagem <> null) { ?>
		<div class="w3-panel w3-red w3-display-container">
			<span onclick="this.parentElement.style.display='none'"
				  class="w3-button w3-large w3-display-topright">&times;</span>
			<h3>Erro!</h3>
			<p><?php echo $mensagem; ?> </p>
		</div>
	<?php 
	} ?>
	
	<input  
					type="text"		
					name="input_login" 	
					autocomplete="on"	
					value="<?php echo $login; ?>"	
					placeholder="E-mail para login..."		/> 	
	<!--input type="password"	name="input_senha" 	autocomplete="off"									placeholder="Senha (minimo 4 numeros)..."			/--> 	
	<input 
					type="password" 	
					name="input_senha"
					autocomplete="current-password"  
					placeholder="Senha (numerica, min 4 numeros)..."	
					inputmode="numeric" 
					minlength="4"
       		maxlength="8" 
					size="8" />

	<button	type="submit" 
			id="botao_ok">
			
		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">add</i>
		Login
	</button>
	
	<?php
	
	if (existe_cookie()) { ?>
		<h4>Voce já está conectado via cookie</h4>
		<br>
		<a 	id="botao_a"
			href="index.php">
		Continuar logado
		</a>
	<?php } ?>
	
	</form> 

	<a 	id="botao_b"
		href="usu_inc.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Cadastrar novo usuario
	</a>
	
	<a 	id="botao_voltar"
		href="usu_login.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>


</body>
</html>