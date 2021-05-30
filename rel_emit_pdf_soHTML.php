<?php 
//* session_start();

	$path_pdf = "c:\\temp\\";
	$arquivo = "relatorio_id_teste.pdf";

	$path_arquivo = $path_pdf . $arquivo;
	
	if (file_exists($path_arquivo)) {
		
		//* abre arquivo no diretorio do servidor
		header("location: " . $path_pdf . $arquivo);
		die();
	}

	require_once 'dompdf/autoload.inc.php';
		
	use Dompdf\Dompdf;

	$dompdf = new Dompdf();

//* formata variavel conteudo para corrigir quebras de linhas do paragrafo

$relatorio = 'cabeca oca';

$aux_conteudo = str_replace(array("\r\n", "\r", "\n"), "<br />", $relatorio);

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

				<div id=\"ref\">ref: 2020/99"</div>				

				<div id=\"corpo\">
					
					Referente à Atendimento em Psicologia
					
					<br>
					<br>
					
					Paciente: RENATO DANIEL BRITO
					
					<br> 
					
					H.D. CIDX n° 666
					
					<br> 
					<br>
					
					" . $aux_conteudo . "
					
					";
						

//* =============================================================

$fileQRCode  = '';
$fileQRCode .= 'qrcode_' . $dado_rel['id'] . '.png';
   
$qrcode  = 'tel: (11) 98014-3803' . "\n";
$qrcode .= 'mailto:psico.lidia@hotmail.com' . "\n";

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
							São Bernardo do Campo, 12 DE OUTUBRO DE 1977.

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

$path_pdf = "";
$arquivo = "relatorio_id" . $getid . ".pdf";

//* gera arquivo e salva em diretorio/servidor
$pdf_string =   $dompdf->output();
file_put_contents($path_pdf . $arquivo, $pdf_string ); 

//* abre arquivo no diretorio do servidor
header("location: " . $path_pdf . $arquivo);
	
 //*   $dompdf->stream($path_pdf . $arquivo);

?>