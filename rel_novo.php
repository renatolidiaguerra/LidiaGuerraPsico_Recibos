<?php
session_start();

$cpf_titular = $_GET['cpf'];
$nome_titular = $_GET['nome'];

$cod_user = $_SESSION['usuario'];

include("i_conecta_relatorios.php");
include("i_formata_cpf.php");

$aux_conteudo = "Paciente iniciou acompanhamento psicoterapêutico em  seguindo encaminhamento médico para tratamento de sintomas compatíveis com CIDX.

É recomendado ao paciente que mantenha sessões de psicoterapia semanais por tempo indeterminado ou até a remissão total dos sintomas.

";

?>

<!DOCTYPE html>
<html>

	<title>Gerador de Relatórios</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" type="text/css" href="i_style.css">

	<div id="header_pagina">
		<h1>Incluir Relatório</h1>
	</div>

	<body>

		<form action="rel_novo_f.php" method="POST">
			CPF
			<input type="hidden" name="input_cpf_titular" 	 				value="<?php echo $cpf_titular;?>" 	>
			<input type="text" 	 name="format_cpf_titular" 	readonly 		value="<?php echo mask($cpf_titular,'###.###.###-##');?>" >
			Nome Titular
			<input type="text" name="input_nome_titular" 	readonly 		value="<?php echo $nome_titular;?>"	>	
			Data da Emissão
			<input type="date" name="input_data_envio"		required  		placeholder="Data de Emissão">
			CIDX
			<input type="text" name="input_cidx"			required  		placeholder="Preencha o CIDX">
			Texto do Relatório
			<textarea 	name="input_conteudo"		required		value=""
																			placeholder="Conteúdo do Relatório"><?php echo $aux_conteudo; ?></textarea>
			<br>
			<br>
			<input id="botao_ok" type="submit" name="IncluirRelatorioNovo" 	value="Gravar Registro">

		</form>

		<a 	id="botao_voltar"
			href="rel_pesq.php">
			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
			Voltar
		</a>

	</body>
</html>