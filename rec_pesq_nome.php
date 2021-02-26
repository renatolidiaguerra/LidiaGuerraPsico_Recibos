<?php
session_start();
?>

<!DOCTYPE html>
<html>
<title>Gerador de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>

$(document).on('click', '.custom-clickable-row', function(e){
	var url = $(this).data('href');
	window.location = url;
});

</script>

<style>
.custom-clickable-row {
	cursor: pointer;
}
</style>

<body>

	<div id="header_pagina">
		<h1>Pesquisar Recibo</h1>
	</div>
	
	<?php

	include("i_conecta_clientes.php");
	include("i_formata_cpf.php");

	$upnome = $_POST['nome'];
	if ($upnome == null) {
		$upnome = "%";
	}
	$cod_user = $_SESSION['usuario'];
	
	$sql = "SELECT cpf, nome, email , telefone
				FROM $tb_clientes
				WHERE nome LIKE '%$upnome%'
				  and cod_user = $cod_user
				ORDER BY nome";
				
	$result = $conn_cli->query($sql);

	if ($result->num_rows > 0) {
	?>
	<table class="w3-responsive w3-hoverable">
		<tr>
			<th>Nome</th>
			<th>CPF</th>
			<th>E-Mail</th>
			<th>Telefone</th>
		</tr>
		
		<?php while($dado = $result->fetch_array()) { ?>
			<tr class="custom-clickable-row" data-href="rec_pesq_recibo.php?cpf=<?php echo $dado['cpf'];?>&nome=<?php echo $dado['nome'];?>">
				<td><?php echo $dado['nome']; ?></td>
				<td><?php echo mask($dado["cpf"],'###.###.###-##'); ?></td>
				<td><?php echo $dado['email']; ?></td>
				<td><?php echo $dado['telefone']; ?></td>
			</tr>
		<?php } ?>
		
	</table>
	
	<?php 
	} else { 
	?>
		<div id="botao_e">
			Nenhum nome encontrado
		</div> 
	<?php
	}
	?>
	
	<a 	id="botao_voltar"
		href="rec_pesq.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
	
</body>
</html>