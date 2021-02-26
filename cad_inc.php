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
	  <h1>Inclusão de Cliente</h1>
	</div>

	<form 	name="nome_formulario" 
			method="post" 
			action="cad_inc_f.php"
			autocomplete="off"		> 
	
	<input type="text"		name="input_cpf" 			required 	placeholder="CPF..."						pattern="[0-9]{11}" 	/> 	
	<input type="text"		name="input_nome" 			required 	placeholder="Nome..."					/> 	
	<input type="text"		name="input_endereco" 					placeholder="Endereço..."				/> 	
	Data Nascimento
	<input type="date" 		name="input_datanascimento" 			placeholder="Data de Nascimento..."		/> 													
	<input type="email"		name="input_email" 					 	placeholder="E-Mail..."					/> 	
	<input type="text"		name="input_telefone"			 		placeholder="Telefone..."				/>
	<input type="text"		name="input_cpf_titular" 		 		placeholder="CPF titular (se existir)..."	pattern="[0-9]{11}" 	/> 	
	
	<button	type="submit" 
			id="botao_ok">
			
		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">add</i>
		Incluir
	</button>

	</form> 

	<a 	id="botao_voltar"
		href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>


</body>

</html>
