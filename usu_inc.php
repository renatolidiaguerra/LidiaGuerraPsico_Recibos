<?php

$mensagem 	= null;
$login 		= null;
$telefone 	= null;
$nome 		= null;

if (isset($_GET['mensagem'])) {
	$login 		= $_GET['login'];
	$telefone 	= $_GET['telefone'];
	$nome 		= $_GET['nome'];
	$mensagem 	= $_GET['mensagem'];
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
	  <h1>Cadastro de Usuario</h1>
	</div>

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

	<form 	name="nome_formulario" 
			method="post" 
			action="usu_inc_f.php"
			autocomplete="off"		> 
			
	<input type="text"		name="input_login" 		value="<?php echo $login;?>" required	autocomplete="off"	placeholder="E-mail para login..."		/> 	
	<input type="number"	name="input_senha1" 	value=""				 	 required	autocomplete="off"	placeholder="Senha..."			/> 	
	<input type="number" 	name="input_senha2" 	value=""					 required	autocomplete="off"	placeholder="Repita a senha..."	/>
	<input type="text"		name="input_telefone"	value="<?php echo $telefone;?>"		 	autocomplete="off"	placeholder="Telefone..."		/>
	<input type="text"		name="input_nome"		value="<?php echo $nome;?>"	 required	autocomplete="off"	placeholder="Nome..."			/> 	
	
	<button	type="submit" 
			id="botao_ok">
			
		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">add</i>
		Incluir
	</button>

	</form> 

	<a 	id="botao_voltar"
		href="usu_login.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>


</body>

</html>
