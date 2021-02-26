<?php
session_start();

include("i_conecta_clientes.php");

$cod_user = $_SESSION['usuario'];

$sql = "SELECT id, cpf, nome, endereco, datanascimento, email , telefone
			FROM $tb_clientes
			WHERE cod_user = '$cod_user'
			ORDER BY nome";
$result = $conn_cli->query($sql);

?> 

<!DOCTYPE html>
<html>
<title>Emissor de Recibos</title>

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
	  <h1>Alteração de Cadastro</h1>
	</div>

	<table class="w3-responsive">
		<tr class="w3-large">
			<th>ID</th>
			<th>Nome</th>
			<th>Telefone</th>
		</tr>
		<?php while($dado = $result->fetch_array()) { ?>
		<tr class="custom-clickable-row" data-href="cad_alt_f.php?id=<?php echo $dado['id'];?>">
			<td><?php echo $dado['id'];?></td>
			<td><?php echo $dado['nome']; ?></td>
			<td><?php echo $dado['telefone']; ?></td>
		</tr>
		<?php } ?>
	</table>
	<br>
	
	<a 	id="botao_voltar"	href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
	
</body>
</html>