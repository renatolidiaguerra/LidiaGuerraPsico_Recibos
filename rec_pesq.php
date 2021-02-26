<!DOCTYPE html>
<html>
<title>Gerador de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<body>

	<div id="header_pagina">
		<h1>Pesquisar Recibo</h1>
	</div>
	
	<form 	name="nome_formulario" 
			method="post" 
			action="rec_pesq_nome.php"
			autocomplete="off"		> 

	<input 	type="text"		
			name="nome"  	
			placeholder="Entre com o nome para pesquisa..."		
			value=""		/> 	
	<br>

	<button type="submit" 
			id="botao_ok">
		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">add</i>
		Pesquisar
	</button>

	<a 	id="botao_voltar"
		href="index.htm">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
	</form>
</body>

</html>
