<?php
session_start();

$cpf_titular = $_GET['cpf'];
$nome_titular = $_GET['nome'];

$cod_user = $_SESSION['usuario'];

include("i_conecta_recibos.php");
include("i_formata_cpf.php");

?>

<!DOCTYPE html>
<html>

	<title>Gerador de Recibos</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" type="text/css" href="i_style.css">

	<div id="header_pagina">
		<h1>Incluir Recibo</h1>
	</div>

	<body>

		<form action="rec_novo_f.php" method="POST">
			
			CPF
			<input 
						type="hidden" 
						name="input_cpf_titular" 	 			
						value="<?php echo $cpf_titular;?>" 	>
			<input 
						type="text" 	 
						name="format_cpf_titular" 	
						readonly 	
						value="<?php echo mask($cpf_titular,'###.###.###-##');?>" >
			
			Nome Titular
			<input 
						type="text" 
						name="input_nome_titular" 	
						readonly 	
						value="<?php echo $nome_titular;?>"	>	
			
			CPF Dependente (se existir)
			<select  name="input_cpf_dependente">
				<option value="">Sem dependente</option>

				<?php	
					include("i_conecta_clientes.php");

					$sql = "SELECT cpf, nome
								FROM $tb_clientes
								WHERE cpf_titular = '$cpf_titular'
								  AND cod_user = '$cod_user'
								ORDER BY nome";
								
					$result = $conn_cli->query($sql);

					if ($result->num_rows > 0) {
						
						while($dado = $result->fetch_array()) { ?>
							<option value="<?php echo $dado['cpf']; ?>"><?php echo $dado['nome'];?></option>
						<?php }				//* NÃO COLOCAR MASCARA AQUI !!!! *//
						
					} 
				?>
			</select>

			Data da Emissão
			<input 
						type="date" 
						name="input_data_envio"		
						required  		
						placeholder="Data de Emissão">
			
			Valor do Recibo
			<input 
						type="text" 
						name="input_valor"			
						required		
						placeholder="Valor">	
			
			Observação (se houver)
			<textarea 
						type="textarea" 
						style="width:100%;height:50%;"
						name="input_observacao">Consultas realizadas nas seguintes datas:</textarea>
			<br>
			<input 
						id="botao_ok" type="submit" name="IncluirReciboNovo" value="Gravar Registro">

		</form>

		<a 	id="botao_voltar"
			href="rec_pesq.php">

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
			Voltar
		</a>

	</body>
</html>