<? php

function carrega_html () {
	//* ================================================
	$saidahtml = "
	<!DOCTYPE html>
	<html>
	<title>Gerador de Recibos</title>

		<style>

		.header, .footer {
			
			height: 250px;
		}
		
		.header-space,
		.footer-space {
		  height: 100px;
		}

		.header {
		  position: fixed;
		  top: 0;
		}

		.footer {
		  position: fixed;
		  bottom: 0;
		}

		#recibo {
			font-size: 40px;	
			text-align: center;
			padding-top: 0px; 
		}

		#ref {
			font-size: 20px;	
			text-align: center;
		}

		#recebi {
			padding-top: 	0%; 
			padding-bottom: 0%; 
			padding-left: 	0%; 
			padding-right: 	0%; 
			
			text-align: justify;
			line-height: 100%;
			font-size: 25px;
		}

		#semmais {
			text-align: right;
			font-size: 25px;
		}

		#assinatura {
			padding-top: 0%;
			font-size: 7px;
			text-align: right;
			color: red;
		}
			
		#fundo {
		color: red;
		}
		body, page { 
			height:297mm; 
			width:210mm; 
			margin-left:0px; 
			margin-right:0px; 
		}
		</style>
	"; 
	//*   --------------------

	//*   --------------------
	$saidahtml .= "
		<body>
		
			<form id=\"fundo\">
			
			<div class=\"header\">
				<img src=\"imagens/cabecalho.jpg\" alt=\"cabecalho\" style=\"width:100%\">
			</div>	
			<table>
				<thead>
					<tr><td>
						<div class=\"header-space\">&nbsp;</div>
					</td></tr>
				</thead>
				
				<tbody>
					<tr><td>
						<div class=\"content\">
							
							<h1 id=\"recibo\">RECIBO </h1>
							
							<h3 id=\"ref\">ref: 2020/" . $dado_rec['id'] . "</h3>
							
							<div id=\"recebi\">
								Recebi de " . $dado_tit['nome'] . ", CPF n° " . mask($dado_rec['cpf_titular'],'###.###.###-##') . " o valor total de 
								R$ " . number_format($dado_rec['valor'], 2, ',', '.') . " (" . numero_extenso($dado_rec['valor']) . " reais) referente ao tratamento de psicoterapia.
	";
	//*   --------------------

	//*   --------------------							
								
								if ($dado_rec['cpf_dependente'] != null) { 
									$saidahtml .= "
									<br>
									CPF do Dependente: " . mask($dado_rec['cpf_dependente'],'###.###.###-##') . "\n " . "
									<br>
									Nome do Dependente: " . $dado_dep['nome'] . "\n " ;
								}
								
								if ($dado_rec['observacao'] != null) {
									$saidahtml .= "
									<br>
									Obs: " . $dado_rec['observacao'] . "\n";
								}
								if ($dado_rec['cpf_dependente'] == null) {
									$saidahtml .= "
									<br> 1
									<br> 2
									<br> 3
									<br>4";
								} 
								if ($dado_rec['observacao'] == null) { 
									$saidahtml .= "
									<br> 5
									<br> 6
									<br> 7
									<br>8";
								}

	//*   --------------------

	//*   --------------------									
	$saidahtml .= 				"
							</div>
							<div id=\"semmais\">
								Sem mais,
								<br>
								São Bernardo do Campo, " . $data_extenso . ".
							</div>
							<div id=\"assinatura\"> 
								Assinatura eletronica:[" . $dado_rec['cryptokey'] . "]
							</div>
						</div>
					</td></tr>
				</tbody>
				<tfoot>
					<tr><td>
						<div class=\"footer-space\">&nbsp;</div>
					</td></tr>
				</tfoot>
			</table>
			
			<div class=\"footer\">
				<img class=\"w3-background\" src=\"imagens/rodape.jpg\" alt=\"Notebook\" style=\"width:100%\">
			</div>
			
			</form>
		</body>
	</html>";

	return $saidahtml;

}