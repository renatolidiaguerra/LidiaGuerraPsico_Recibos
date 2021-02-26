<?php
session_start();

$getid = $_GET['id']; 
$cod_user = $_SESSION['usuario'];

include("i_conecta_recibos.php");
include("i_numero_extenso.php");
include("i_formata_cpf.php");
include('phpqrcode/qrlib.php');

/* pesquisa dados do recibo */

$sql_rec = "SELECT id, cpf_titular, cpf_dependente, data_envio, valor, observacao, cryptokey
			FROM $tb_recibos
			WHERE id = '$getid'";
			
$result_rec = $conn_rec->query($sql_rec);

$dado_rec = $result_rec->fetch_array();

/* pesquisa dados do titular */

include("i_conecta_clientes.php");

$cpf_titular = $dado_rec['cpf_titular'];

$sql_tit = "SELECT nome, email
			FROM $tb_clientes
			WHERE cpf = '$cpf_titular'
			  AND cod_user = '$cod_user'";

$result_tit = $conn_cli->query($sql_tit);
$dado_tit =  $result_tit->fetch_array();

/* pesquisa dados do dependente */

$cpf_dependente = $dado_rec['cpf_dependente'];
$sql_dep = "SELECT nome
			FROM $tb_clientes
			WHERE cpf = '$cpf_dependente'
			  AND cod_user = '$cod_user'";

$result_dep = $conn_cli->query($sql_dep);

$dado_dep =  $result_dep->fetch_array();

/* define data por extenso */
setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$date = date($dado_rec['data_envio']);
//* $data_extenso = strftime("%d de %B de %Y", strtotime($date)); 

if (strftime("%m") == 03) {
	$data_extenso = strftime("%d de março de %Y", strtotime($date));
}
else {
	$data_extenso = strftime("%d de %B de %Y", strtotime($date));
}

//* =============================================================

$fileQRCode  = 'recibos/qrcode/';
$fileQRCode .= 'qrcode_' . $dado_rec['id'] . '.png';
   
$qrcode  = 'tel: (11) 98014-3803' . "\n";
$qrcode .= 'mailto:psico.lidia@hotmail.com' . "\n";

$qrcode .= "[ID: " . $dado_rec['id'] . "]\n";
$qrcode .= "Tit: " . $dado_tit['nome'] . "\n";
$qrcode .= "CPF: " . $dado_rec['cpf_titular'] . "\n";
$qrcode .= "Vlr: R$ " . number_format($dado_rec['valor'], 2, ',', '.') . "\n";
$qrcode .= "Dep: " . $dado_dep['nome'] . "\n";
$qrcode .= "CPF: " . $dado_rec['cpf_dependente'] . "\n";
$qrcode .= "Obs: " . $dado_rec['observacao'] . "\n";
$qrcode .= "Data:" . strftime("%d/%m/%Y", strtotime($date)) . "\n";

QRcode::png($qrcode, $fileQRCode , QR_ECLEVEL_L, 3);

//* =============================================================

?>

<!DOCTYPE html>
<html>
<title>Gerador de Recibos</title>

<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<style>

	#recibo {
		font-size: 8vmin;
		text-align: center;
		padding-top: 25vmin;
	}

	#ref {
		font-size: 4vmin;	
		text-align: center;
	}
	
	#corpo {
		height: 55vmin;
		padding-top: 	 5%; 
		padding-bottom:  0%; 
		padding-left: 	 5%; 
		padding-right: 	 5%; 
		
		text-align: justify;
	}

	#semmais {
		text-align: right;
	}
	#semmais, #corpo {
		font-size: 3vmin;
	}
	
	#crp {
		color: black;
		font-size: 10px;
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
		<h1>Recibo gerado com Sucesso!</h1>
	</div>
	
	<body class="w3-responsive w3-mobile">

		<form id="fundo">
				
			<div id="recibo">RECIBO</div>

			<div id="ref">ref: 2020/<?php echo $dado_rec['id']; ?></div>				

			<div id="corpo">
			
				Recebi de <?php echo $dado_tit['nome']; ?>, CPF nº <?php echo mask($dado_rec['cpf_titular'],'###.###.###-##'); ?> o valor total de 
					R$ <?php echo number_format($dado_rec['valor'], 2, ',', '.'); ?> (<?php echo numero_extenso($dado_rec['valor']); ?> reais) referente ao tratamento com psicóloga.

<?php				if ($dado_rec['cpf_dependente'] != null) { ?>
						<br> <br>
						CPF do Dependente: <?php echo mask($dado_rec['cpf_dependente'],'###.###.###-##'); ?>
						<br> <br>
						Nome do Dependente: <?php echo $dado_dep['nome'];
					} 
					
					if ($dado_rec['observacao'] != null) { ?>
						<br> <br>
						Obs: <?php echo $dado_rec['observacao']; 
					} ?> 
					
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
					CPF: 220.690.618-09        CRP/SP: 06/79797				
				</div>

			</div>						

		</form>
			
	</body>	
	
		<!-- exibe botao gerar PDF -->
		<a 	id="botao_ok"
			href="rec_emit_pdf.php?id=<?php echo $getid;?>">

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">save</i>
			Arquivo PDF Rubricado
		</a>

		<!-- exibe botao gerar PDF sem assinatura-->
		<a 	id="botao_a"
			href="rec_emit_pdf_branco.php?id=<?php echo $getid;?>">

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">save</i>
			Arquivo PDF sem Assinatura
		</a>
					
		<!-- exibe botao voltar -->
		<a 	id="botao_voltar"
			href="rec_pesq.php">

			<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
			Voltar
		</a>	


</html>