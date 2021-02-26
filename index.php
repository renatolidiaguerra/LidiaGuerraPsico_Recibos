<?php

session_start();

include('i_print.php');
include('i_controla_cookie.php');
include('i_controla_sessao.php');


if (!existe_sessao()) {
	exibe("nao existe sessao?");
	header('location: usu_login.php');
	die();
}
?>

<!DOCTYPE html>
<html>
<title>Gerador de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<body>

	<a 	id="botao_a"
		href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">person</i>
		Cadastro
	</a>
	<a 	id="botao_b"
		href="rec_pesq.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">mode_edit</i>
		Recibos
	</a>

	<a 	id="botao_c"
		href="rel_pesq.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">local_hospital</i>
		Relatórios Médicos
	</a>

	<a 	id="botao_d"
		href="dados.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">apps</i>
		Extração de Dados
	</a>

	<a 	id="botao_e"
		href="aju.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">help</i>
		Ajuda
	</a>


</body>

</html>