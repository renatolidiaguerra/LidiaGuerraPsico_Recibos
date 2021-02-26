<?php 
session_start();

	$getid = $_GET['id']; 
	$cod_user = $_SESSION['usuario'];

	$path_pdf = "recibos/";
	$arquivo = "recibo_id" . $getid . ".pdf";

	$path_arquivo = $path_pdf . $arquivo;
	
	if (file_exists($path_arquivo)) {
		
		//* abre arquivo no diretorio do servidor
		
		//* comentarizando o 'abrir arquivo existente' e incluindo deletar arquivo
		header("location: " . $path_pdf . $arquivo);
		die();
		//*unlink($path_arquivo);
	}

	require_once 'dompdf/autoload.inc.php';
		
	use Dompdf\Dompdf;

	$dompdf = new Dompdf();

//*	$dompdf = new Dompdf(array('enable_remote' => true));
	
//* ---------------------------------------------------

	include('i_conecta_recibos.php');
	include('i_numero_extenso.php');
	include('i_formata_cpf.php');
	include('phpqrcode/qrlib.php');
	
/* pesquisa dados do recibo */

	$sql_rec = "SELECT id, cpf_titular, cpf_dependente, data_envio, valor, observacao, cryptokey
				FROM $tb_recibos
				WHERE id = '$getid'
				  AND cod_user = '$cod_user'";
				
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

	if (strftime("%m", strtotime($date)) == 03) {
		$data_extenso = strftime("%d de março de %Y", strtotime($date));
	}
	else {
		$data_extenso = strftime("%d de %B de %Y", strtotime($date));
	}
	$ano_referencia = strftime("%Y", strtotime($date));

//* =============================================================

$saidahtml = "
<!DOCTYPE html>
<html>
<title>Gerador de Recibos</title>
<meta charset=\"UTF-8\">
<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">
<style>

	table, th, td {
		border: 0px solid black;
		border-collapse: collapse;
	}
	th, td {
		text-align: left;
	}
	
	.header-space {
		height: 35mm;
	}
	
	.footer-space {
		height: 50mm;
		font-size: 20px;
		text-align: right;
	}

	#header {
		height: 30mm;
		position: fixed;
		top: 0;
	}

	#footer {
		height: 20mm;
		position: fixed;
		bottom: 0;
	}
	
	table {
		width: 187mm;
	}

	#recibo {
		font-size: 50px;	
		text-align: center;
	}

	#ref {
		font-size: 30px;	
		text-align: center;
	}
	
	#corpo {
		height: 115mm;
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
		font-size: 20px;
	}
	
	#rubrica {
		padding-top: 10px;
		text-align: center;
	}
	
	#crp {
		color: black;
		font-size: 10px;
		font-family: Arial;
		text-align: center;
	}
	
	#qrcode {
		padding-top: 20px;
	}

</style>

	<body>

		<form>

		
		<div id=\"header\">
			<img src=\"imagens/cabecalho.jpg\" alt=\"cabecalho\" style=\"width:100%\">
		</div>	
		<table>
			<thead>
				<tr><td>
					<div class=\"header-space\">

					</div>
				</td></tr>
			</thead>

			<tbody>
				<tr><td>
				
				<div id=\"recibo\">RECIBO</div>

				<div id=\"ref\">ref: " . $ano_referencia . "/" . $dado_rec['id'] . "</div>				

				<div id=\"corpo\">
				
					Recebi de " . $dado_tit['nome'] . ", CPF nº " . mask($dado_rec['cpf_titular'],'###.###.###-##') . " o valor total de 
						R$ " . number_format($dado_rec['valor'], 2, ',', '.') . " (" . numero_extenso($dado_rec['valor']) . " reais) referente ao tratamento com psicóloga.

";
//* =============================================================

//* =============================================================

						if ($dado_rec['cpf_dependente'] != null) { 
							$saidahtml .= "
							<br> <br>
							CPF do Dependente: " . mask($dado_rec['cpf_dependente'],'###.###.###-##') . "\n " . "
							<br> <br>
							Nome do Dependente: " . $dado_dep['nome'] . "\n " ;
						}
						
						if ($dado_rec['observacao'] != null) {
							$saidahtml .= "
							<br> <br>
							Obs: " . $dado_rec['observacao'] . "\n";
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
$saidahtml .= 				"

				</div>
				</td></tr>
			</tbody>
			<tfoot>
				<tr><td>
					<div class=\"footer-space\">
					
						<div id=\"qrcode\" class=\"w3-third\">
							<img src=\"" . $fileQRCode . "\"  style=\"  position: absolute;
																		top: 760px;
																		left: 15;
																		width: 180px;
																		height: 180px;\" />
						</div>
						
						<div id=\"semmais\" class=\"w3-twothird\">
							Sem mais,
							<br>
							São Bernardo do Campo, " . $data_extenso . ".
							
							<div id=\"rubrica\">
								<img src=\"imagens/rubrica.jpg\" alt=\"rubrica\" style=\"width:240px\">
							</div>
							
							<div id=\"crp\">
								Lidia Maria Guerra Brito 	<br>
								CPF: 220.690.618-09        CRP/SP: 06/79797				
							</div>

						</div>						
					</div>
				</td></tr>
			</tfoot>
		</table>
		
		<div id=\"footer\">
			<img src=\"imagens/rodape.jpg\" alt=\"rodape\" style=\"width:100%;\">
		</div>
		
		</div>

		</form>
			
	</body>

</html>";
//* =============================================================

$dompdf->loadHtml($saidahtml);

//* $dompdf->setPaper('A4', 0, 0, 300, 210);
$dompdf->setPaper('A4', 'portrait');
//*                  (array(0, 0, [height],[width])

$dompdf->render();

$path_pdf = "recibos/";
$arquivo = "recibo_id" . $getid . ".pdf";

$modo = 'salvar'; //* salvar ou enviar

if ($modo == 'salvar') {
	//* gera arquivo e salva em diretorio/servidor
	$pdf_string =   $dompdf->output();
	file_put_contents($path_pdf . $arquivo, $pdf_string ); 
	
	//* abre arquivo no diretorio do servidor
	header("location: " . $path_pdf . $arquivo);
	
 //*   $dompdf->stream($path_pdf . $arquivo);
} else {
	$pdf_string =   $dompdf->output();
	file_put_contents($path_pdf . $arquivo, $pdf_string ); 

	//* echo "arquivo gerado com sucesso";
	
	//* ---------------------------------------------------
	//* ---------------------------------------------------
	
	$de_email	= 'psico.lidia@hotmail.com';
	$de_nome	= 'Lidia Guerra Psicologa (via app)';
	$para_email	= $dado_tit['email'];
	$para_nome	= $dado_tit['nome'];
	$corpo  	= '<p>Aqui esta seu recibo. <br><br> Obrigado<br>Lidia Guerra';
	$titulo		= '## Recibo de Psicologia ##';
	$arquivo	= $path_pdf . $arquivo;
	
	//* >>>
	 include('rec_emit_email.php');
	//* >>>
}
?>