<?php

Session_start();

$getid = $_GET['id'];
$cod_user = $_SESSION['usuario'];

include("i_conecta_recibos.php"); 
include("i_formata_cpf.php");

$sql = "SELECT id, cpf_titular, cpf_dependente, data_envio, valor, observacao
			FROM $tb_recibos
			WHERE id = '$getid'
			  AND cod_user = '$cod_user'";
			
$result = $conn_rec->query($sql);

$dado = $result->fetch_array();
?>

<!DOCTYPE html>
<html>
	<title>Gerador de Recibos</title>

	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" type="text/css" href="i_style.css">

	<body>
		<div id="header_pagina">
			<h1>Consulta de Recibo n. <?php echo date('Y', strtotime($dado['data_envio'])) . "/" . $getid;?> </h1>
		</div>
		<form>

			<?php 	if ($result->num_rows > 0) {?>
			
				CPF Titular 		<input type="text" 	readonly	placeholder="CPF Titular"		value="<?php echo mask($dado['cpf_titular'],'###.###.###-##');?>"	<br >
				CPF Dependente		<input type="text" 	readonly	placeholder=""					value="<?php echo $dado['cpf_dependente'];?>"> <br >
				Data da Emissão		<input type="text" 	readonly	placeholder="Data de Emiss���o"	value="<?php echo date('d/m/Y', strtotime($dado['data_envio']));?>"> <br >
				Valor				<input type="text" 	readonly	placeholder="Valor"				value="<?php echo "R$ " . number_format( $dado['valor'] , 2, ',', '.');;?>"> <br >
				Observação 			<input type="text" 	readonly	placeholder=""					value="<?php echo $dado['observacao'];?>"> <br >

			<?php 
			}?>

			<a 	id="botao_ok"
				href="rec_emit_pdf.php?id=<?php echo $getid;?>">
				<i class="material-icons w3-xxlarge w3-cell-middle w3-left">mail_outline</i>
					Abrir arquivo PDF
			</a>

<!---------------------------------------->
			<a 	id="botao_e"
				href="rec_excl.php?id=<?php echo $getid;?>">
				<i class="material-icons w3-xxlarge w3-cell-middle w3-left">delete</i>
					Excluir Recibo
			</a>
<!---------------------------------------->
			<a 	id="botao_voltar"
				href="rec_pesq.php">

				<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
				Voltar
			</a>
		</form>	
	</body>

</html>