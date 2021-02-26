<?php
session_start();
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

	<?php

	include("i_conecta_clientes.php");
	
	$cod_user = $_SESSION['usuario'];

	$getid = $_GET['id'];
	$consulta = "SELECT id, cpf, nome, email, endereco, datanascimento, telefone, cpf_titular 
				   FROM $tb_clientes 
				   WHERE id = '$getid'
				     AND cod_user = '$cod_user'";
	$qry = mysqli_query($conn_cli, $consulta);
	$query_assoc = mysqli_fetch_assoc($qry);

	$id 			= $query_assoc['id'];
	$cpf 			= $query_assoc['cpf'];
	$nome 			= $query_assoc['nome'];
	$email 			= $query_assoc['email'];
	$endereco 		= $query_assoc['endereco'];
	$dtnasc			= $query_assoc['datanascimento'];
	$telefone		= $query_assoc['telefone'];
	$cpf_titular 	= $query_assoc['cpf_titular'];

	if(isset($_POST['updateedit'])) {
		$upid 		 =  $_POST['upid'];
		$upcpf  	 =  $_POST['upcpf'];
		$upnome 	 =  $_POST['upnome'];
		$upemail 	 =  $_POST['upemail'];
		$upendereco  =  $_POST['upendereco'];
		$updtnasc 	 =  $_POST['updtnasc'];
		$uptelefone	 =  $_POST['uptelefone'];
		$upcpf_titular= $_POST['upcpf_titular'];

		$seleditt = "UPDATE $tb_clientes 
						SET cpf = '$upcpf', 
							nome = '$upnome', 
							endereco = '$upendereco', 
							email = '$upemail', 
							datanascimento = '$updtnasc', 
							telefone = '$uptelefone',
							cpf_titular = '$upcpf_titular'
						WHERE id = '$upid'
						  AND cod_user = '$cod_user'";
		$qry = mysqli_query($conn_cli,$seleditt);

		if($qry) {
			header("location: msg_sucesso.php?destino='cad_alt.php'");
		}
	}

	?>
	
	<div id="header_pagina">
	  <h1>Alteração id [<?php echo $id;?>]</h1>
	</div>
	
	<form method="POST" action="">

		<input type="hidden" name="upid" 	   value="<?php echo $id; ?>" 													/> 
		CPF
		<input type="text" 	name="upcpf" 	   value="<?php echo $cpf; ?>"  		required 	pattern="[0-9]{11}}"	placeholder="CPF..."				/> <br>
		Nome
		<input type="text" 	name="upnome" 	   value="<?php echo $nome ; ?>" 		required 							placeholder="Nome..."				/> <br>
		Endereço
		<input type="text"	name="upendereco"  value="<?php echo $endereco ; ?>"										placeholder="Endereço..."			/> <br>
		E-Mail
		<input type="text" 	name="upemail" 	   value="<?php echo $email; ?>"											placeholder="Data de Nascimento..."	/> <br>
		Data de Dascimento
		<input type="date" 	name="updtnasc"	   value="<?php echo $dtnasc ; ?>"		required 							placeholder="E-Mail..."				/> <br>
		Telefone
		<input type="text"	name="uptelefone"  value="<?php echo $telefone ; ?>"			 							placeholder="Telefone..."			/> <br>
		CPF do Titular (se existir)
		<input type="text"	name="upcpf_titular" value="<?php echo $cpf_titular; ?>"  			pattern="[0-9]{11}"		placeholder="CPF titular (se existir)..."	/> <br>
		
		<input  type="submit" name="updateedit" value="Atualizar Dados"  
				id="botao_ok">
		
	</form>
	<a 	id="botao_voltar"	href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
</body>
</html>
