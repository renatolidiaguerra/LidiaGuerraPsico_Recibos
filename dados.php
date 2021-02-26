<!DOCTYPE html>
<?php
session_start();
?>

<html>
<title>Gerador de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<body>

	<a 	id="botao_a"
		href="dados_input.php?dias=7">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">alarm_on</i>
		Últimos 7 dias
	</a>
	
	<a 	id="botao_b"
		href="dados_input.php?dias=15">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">hourglass_empty</i>
		Últimos 15 dias
	</button>

	<a 	id="botao_c"
		href="dados_input.php?dias=30">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">restore</i>
		Últimos 30 dias
	</button>
	
	<a 	id="botao_d"
		href="dados_input.php?dias=99">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">language</i>
		Ano Atual
	</button>

	<a 	id="botao_e"
		href="dados_input.php?dias=999">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">skip_previous</i>
		Ano Anterior
	</button>

	<a 	id="botao_voltar"
		href="index.htm">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Menu Principal
	</button>

</body>

</html>