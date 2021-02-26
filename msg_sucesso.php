<?php

$destino = $_GET['destino'];

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

<!-- exibe botão voltar -->

	<div class="w3-container">
		<h1 class="w3-quarter"></h1>
		<h1 class="w3-center w3-card-4 w3-animate-right w3-padding-64 w3-green w3-half">Sucesso!</h1>
	</div> 

	<a 	id="botao_voltar"
		href=<?php echo $destino;?>>

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>

</body>
</html>