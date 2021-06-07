<?php
session_start();

$getid = $_GET['id']; 
$cod_user = $_SESSION['usuario'];

include("i_conecta_relatorios.php");
include("i_numero_extenso.php");
include("i_formata_cpf.php");
include('phpqrcode/qrlib.php');

/* pesquisa dados do relatorio */

$sql_rel = "SELECT id, cpf_titular, data_envio, cidx, conteudo, cryptokey
			FROM $tb_relatorios
			WHERE id = '$getid'";
			
$result_rel = $conn_rel->query($sql_rel);

$dado_rel = $result_rel->fetch_array();

/* pesquisa dados do titular */

include("i_conecta_clientes.php");

$cpf_titular = $dado_rel['cpf_titular'];

$sql_tit = "SELECT nome, email
			FROM $tb_clientes
			WHERE cpf = '$cpf_titular'
			  AND cod_user = '$cod_user'";

$result_tit = $conn_cli->query($sql_tit);
$dado_tit =  $result_tit->fetch_array();

/* define data por extenso */
setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$date = date($dado_rel['data_envio']);

if (strftime("%m", strtotime($date)) == 03) {
	$data_extenso = strftime("%d de março de %Y", strtotime($date));
}
else {
	$data_extenso = strftime("%d de %B de %Y", strtotime($date));
}
$ano_referencia = strftime("%Y", strtotime($date));

//* =============================================================

$fileQRCode  = 'recibos/qrcode/';
$fileQRCode .= 'qrcode_' . $dado_rel['id'] . '.png';
   
$qrcode  = 'tel: (11) 98014-3803' . "\n";
$qrcode .= 'mailto:psico.lidia@hotmail.com' . "\n";

$qrcode .= "[ID: " . $dado_rel['id'] . "]\n";
$qrcode .= "Tit: " . $dado_tit['nome'] . "\n";
$qrcode .= "CIDX:" . $dado_rel['cidx'] . "\n";
$qrcode .= "Rel: " . $dado_rel['conteudo'] . "\n";
$qrcode .= "Data:" . strftime("%d/%m/%Y", strtotime($date)) . "\n";

QRcode::png($qrcode, $fileQRCode , QR_ECLEVEL_L, 3);

//* =============================================================

?>

<!DOCTYPE html>
<html>
<title>Gerador de Relatórios</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<style>

	#relatorio {
		font-size: 8vmin;
		text-align: center;
		padding-top: 25vmin;
	}

	#ref {
		font-size: 4vmin;	
		text-align: center;
	}
	
	<!-- 1a.linha: height: 55vmin; -->
	#corpo {
		padding-top: 	 5%; 
		padding-bottom:  0%; 
		padding-left: 	 5%; 
		padding-right: 	 5%; 
		
		text-align: justify;
	}
	
	textarea {
		white-space: pre-wrap;
		height: 50%;
		
	}

	#semmais {
		text-align: right;
	}
	#semmais, #corpo, textarea {
		font-size: 3vmin;
	}
	
	#crp {
		color: black;
		font-size: 3vmin;
		font-family: Arial;
		text-align: right;
		padding-bottom: 5vmin;
	}

	#fundo {
		height:100%;
		width:100%;
		background: url(imagens/logo_pag.jpg);
		background-repeat: no-repeat;
		background-opacity: 1;
		
		background-size: 100%;
		background-position: top;
		
		margin: auto;
	}
	
</style>

	<div id="header_sucesso">
		<h1>Relatório gerado com Sucesso!</h1>
	</div>
	
	<body class="w3-responsive w3-mobile">

		<form id="fundo">
				
			<div id="relatorio">RELATORIO</div>
			
			<div id="ref">ref: <?php echo $ano_referencia . '/' . $dado_rel['id']; ?></div>				

			<div id="corpo">
			
				Referente à Atendimento em Psicologia
				<br>
				<br>
				Paciente: <?php echo $dado_tit['nome']; ?>
				<br> 
				H.D.: CIDX n° <?php echo $dado_rel['cidx']; ?>
				<br>
				<br>
				<?php 
				$aux_conteudo = str_replace(array("\r\n", "\r", "\n"), "<br />", $dado_rel['conteudo']);
				echo $aux_conteudo;
				?> 
			</div>

			<div id="semmais" class="w3-twothird">
				Sem mais,
				<br>
				São Bernardo do Campo, <?php echo $data_extenso; ?>.

				<div id="rubrica">
					<img src="imagens/rubrica.jpg" alt="rubrica" style="width:36vmin">
				</div>
				
				<div id="crp">
					Lidia Maria Guerra Brito 	<br>
					CPF: 220.690.618-09     CRP/SP: 06/79797				
				</div>

			</div>						

		</form>
			
	</body>	
	
		<!-- exibe botao gerar PDF -->
		<a 	id="botao_ok"
			href="rel_emit_pdf.php?id=<?php echo $getid;?>">

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">save</i>
			Gerar arquivo PDF
		</a>
					
		<!-- exibe botao voltar -->
		<a 	id="botao_voltar"
			href="rel_pesq.php">

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
			Voltar
		</a>	


</html>