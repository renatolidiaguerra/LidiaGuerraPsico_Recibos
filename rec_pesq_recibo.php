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

	$getcpf = $_GET['cpf'];
	$getnome = $_GET['nome'];
	$cod_user = $_SESSION['usuario'];

	include("i_conecta_recibos.php");
	include("i_formata_cpf.php");

	$sql = "SELECT id, cpf_titular, cpf_dependente, data_envio, valor, observacao
				FROM $tb_recibos
				WHERE cpf_titular = '$getcpf'
				  and cod_user = '$cod_user'
				  and status = 1
				ORDER BY data_envio";
				
	$result = $conn_rec->query($sql);
	
	if ($result->num_rows > 0) { ?>
		<table class="w3-responsive w3-hoverable">
			<tr>
				<!--th style="width:20px;" ></th-->
				<th>CPF Titular</th>
				<th>Nome Titular</th>
				<th>Data Envio</th>
				<th>Valor</th>
			</tr>
			<?php while($dado = $result->fetch_array()) { ?>
			<tr class="custom-clickable-row" data-href="rec_exib.php?id=<?php echo $dado['id'];?>">
				<!--td>
					<i class="material-icons w3-xlarge w3-cell-middle w3-left ">email</i></td-->
				<td><?php echo mask($dado['cpf_titular'],'###.###.###-##');?></td>
				<td><?php echo $getnome; ?></td>
				<td><?php echo date('d/m/Y', strtotime($dado['data_envio'])); ?></td>
				<td><?php echo "R$ " . number_format( $dado['valor'] , 2, ',', '.');?></td>
			</tr>
			<?php } ?>
		</table>
	<?php 
	} else { ?>
		<div id="botao_e">
			Nenhum recibo emitido
		</div> 
	<?php
	}?>

	<a 	id="botao_ok"
		href="rec_novo.php?cpf=<?php echo $getcpf;?>&nome=<?php echo $getnome;?>">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">add</i>
		Criar Recibo
	</a>
	
	<a 	id="botao_voltar"
		href="rec_pesq.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
</body>
</html>