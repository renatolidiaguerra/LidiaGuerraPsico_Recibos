<?php
session_start();
?>

<!DOCTYPE html>
<html>
<title>Gerador de Relatórios</title>

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
		<h1>Pesquisar Relatório</h1>
	</div>
	
	<?php

	$getcpf = $_GET['cpf'];
	$getnome = $_GET['nome'];
	$cod_user = $_SESSION['usuario'];

	include("i_conecta_relatorios.php");
	include("i_formata_cpf.php");

	$sql = "SELECT id, cpf_titular, data_envio
				FROM $tb_relatorios
				WHERE cpf_titular = '$getcpf'
				  and cod_user = '$cod_user'
				ORDER BY data_envio";
				
	$result = $conn_rel->query($sql);
	
	if ($result->num_rows > 0) { ?>
		<table class="w3-responsive w3-hoverable">
			<tr>
				<th>CPF Titular</th>
				<th>Nome Titular</th>
				<th>Data Envio</th>
			</tr>
			<?php while($dado = $result->fetch_array()) { ?>
			<tr class="custom-clickable-row" data-href="rel_exib.php?id=<?php echo $dado['id'];?>">
				<td><?php echo mask($dado['cpf_titular'],'###.###.###-##');?></td>
				<td><?php echo $getnome; ?></td>
				<td><?php echo date('d/m/Y', strtotime($dado['data_envio'])); ?></td>
			</tr>
			<?php } ?>
		</table>
	<?php 
	} else { ?>
		<div id="botao_e">
			Nenhum relatório emitido
		</div> 
	<?php
	}?>

	<a 	id="botao_ok"
		href="rel_novo.php?cpf=<?php echo $getcpf;?>&nome=<?php echo $getnome;?>">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">add</i>
		Criar Relatório
	</a>
	
	<a 	id="botao_voltar"
		href="rel_pesq.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
</body>
</html>