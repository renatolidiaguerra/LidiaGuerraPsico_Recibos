<?php 
session_start();

	$getid = $_GET['id']; 
	$cod_user = $_SESSION['usuario'];

	$path_pdf = "recibos/";
	$arquivo = "relatorio_id" . $getid . ".pdf";

	$path_arquivo = $path_pdf . $arquivo;
	
	if (file_exists($path_arquivo)) {
		
		//* abre arquivo no diretorio do servidor
		header("location: " . $path_pdf . $arquivo);
		die();
	}

	require_once 'dompdf/autoload.inc.php';
		
	use Dompdf\Dompdf;

	$dompdf = new Dompdf();

//*	$dompdf = new Dompdf(array('enable_remote' => true));
	
//* ---------------------------------------------------

	include('i_conecta_relatorios.php');
	include('i_numero_extenso.php');
	include('i_formata_cpf.php');
	include('phpqrcode/qrlib.php');
	
/* pesquisa dados do relatorio */

	$sql_rel = "SELECT id, cpf_titular, data_envio, cidx, conteudo, cryptokey
				FROM $tb_relatorios
				WHERE id = '$getid'
				  AND cod_user = '$cod_user'";
				
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

//* formata variavel conteudo para corrigir quebras de linhas do paragrafo

$aux_conteudo = str_replace(array("\r\n", "\r", "\n"), "<br />", $dado_rel['conteudo']);

//* =============================================================

$saidahtml = "
<!DOCTYPE html>
<html>
<title>Gerador de Relatorios</title>
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
		text-align: right;
	}
	
	table {
		width: 187mm;
	}

	#relatorio {
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
		text-align: right;
	}
	
	#crp {
		color: black;
		font-size: 14px;
		font-family: Arial;
		text-align: left;
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
				
				<div id=\"relatorio\">RELATORIO</div>

				<div id=\"ref\">ref: 2020/" . $dado_rel['id'] . "</div>				

				<div id=\"corpo\">
					
					Referente à Atendimento em Psicologia
					
					<br>
					<br>
					
					Paciente: " . $dado_tit['nome'] . "
					
					<br> 
					
					H.D. CIDX n° " . $dado_rel['cidx'] . "
					
					<br> 
					<br>
					
					" . $aux_conteudo . "
					
					";
						

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
$saidahtml .= 				"

				</div>
				</td></tr>
			</tbody>
			<tfoot>
				<tr><td>
					<div class=\"footer-space\">
					
						<div id=\"qrcode\" class=\"w3-third\">
							<img src=\"" . $fileQRCode . "\"  style=\"width: 180px;\" />
						</div>
						
						<div id=\"semmais\" class=\"w3-twothird\">
							Sem mais,
							<br>
							São Bernardo do Campo, " . $data_extenso . ".

							<div id=\"rubrica\">
								<img src=\"imagens/rubrica.jpg\" alt=\"rubrica\" style=\"width:240px\">
							</div>
							
							<div id=\"crp\" style=\"margin-right: 10px; 
													margin-left: 200px;
													text-align: center\">
								<p>Lidia Maria Guerra Brito<br>
								CPF:220.690.618-09  CRP/SP:06/79797  </p>
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
$arquivo = "relatorio_id" . $getid . ".pdf";

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
	$corpo  	= '<p>Aqui esta seu relatorio. <br><br> Obrigado<br>Lidia Guerra';
	$titulo		= '## relatorio de Psicologia ##';
	$arquivo	= $path_pdf . $arquivo;
	
	//* >>>
	 include('rel_emit_email.php');
	//* >>>
}
?>