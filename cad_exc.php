<?php
session_start();

include("i_conecta_clientes.php");
include("i_formata_cpf.php");

$cod_user = $_SESSION['usuario'];

$sql = "SELECT id, cpf, nome, endereco, datanascimento, email , telefone
			FROM $tb_clientes
			WHERE cod_user = '$cod_user'
			ORDER BY nome";
$result = $conn_cli->query($sql);

?> 

<!DOCTYPE html>
<html>
<title>Exclusão de Cliente</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<body>

	<div id="header_pagina">
	  <h1>Exclusão de Cliente</h1>
	</div>

	<table class="w3-responsive w3-hoverable">
		<tr class="w3-red	w3-large">
			<th style="width:20px;" ></th>
			<th>ID</th>
			<th>Nome</th>
			<th>CPF</th>
		</tr>
		<?php while($dado = $result->fetch_array()) { ?>
		<tr class="w3-striped">
			<td><a href="cad_exc_f.php?id=<?php echo $dado['id'];?>">	
			<i class="material-icons w3-xlarge w3-cell-middle w3-left ">delete</i>
			<td><?php echo $dado['id']; ?></td>
			<td><?php echo $dado['nome']; ?></td>
			<td><?php echo mask($dado['cpf'],'###.###.###-##') ?></td>
		</tr>
		<?php } ?>
	</table>
	<br>
	
	<a 	id="botao_voltar"
		href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
	
</body>
</html>