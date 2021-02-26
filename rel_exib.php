<?php

Session_start();

$getid = $_GET['id'];
$cod_user = $_SESSION['usuario'];

include("i_conecta_relatorios.php"); 
include("i_formata_cpf.php");

$sql = "SELECT id, cpf_titular, data_envio, cidx, conteudo
			FROM $tb_relatorios
			WHERE id = '$getid'
			  AND cod_user = '$cod_user'";
			
$result = $conn_rel->query($sql);

$dado = $result->fetch_array();
?>

<!DOCTYPE html>
<html>
	<title>Gerador de Relatorios</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" type="text/css" href="i_style.css">

	<body>
		<div id="header_pagina">
			<h1>Consulta de Relatórios n. <?php echo date('Y', strtotime($dado['data_envio'])) . "/" . $getid;?> </h1>
		</div>
		<form>

	<?php 	if ($result->num_rows > 0) {?>
			
				CPF Titular 		<input type="text" 	readonly	placeholder="CPF Titular"		value="<?php echo mask($dado['cpf_titular'],'###.###.###-##');?>"	<br >
				Data da Emissão		<input type="text" 	readonly	placeholder="Data de Emissão"	value="<?php echo date('d/m/Y', strtotime($dado['data_envio']));?>"> <br >

			<?php 
			}?>

				<a 	id="botao_ok"
					href="rel_emit_pdf.php?id=<?php echo $getid;?>&usuario=<?php echo $cod_user;?>">
					<i class="material-icons w3-xxlarge w3-cell-middle w3-left">mail_outline</i>
						Abrir arquivo PDF
				</a>

				<a 	id="botao_voltar"
					href="rel_pesq.php">

					<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
					Voltar
				</a>
		</form>	
	</body>

</html>