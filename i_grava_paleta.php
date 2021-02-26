<?php

function gravapaleta($fundo, $letra) {
	
	$saida = '
	#botao_a:hover, 
	#botao_b:hover, 
	#botao_c:hover, 
	#botao_d:hover, 
	#botao_e:hover, 
	#botao_ok:hover, 
	#botao_voltar:hover {
		background-color: ' . $fundo[0] . ';
		color:	' . $letra[0] . ';
	}

	#botao_a {
		background-color: ' . $fundo[1] . ';
		color:	' . $letra[1] . ';
	}

	#botao_b {
		background-color: ' . $fundo[2] . ';
		color:	' . $letra[2] . ';
	}

	#botao_c {
		background-color: ' . $fundo[3] . ';
		color:	' . $letra[3] . ';
	}

	#botao_d {
		background-color: ' . $fundo[4] . ';
		color:	' . $letra[4] . ';
	}

	#botao_e {
		background-color: ' . $fundo[5] . ';
		color:	' . $letra[5] . ';
	}

	#botao_ok {
		background-color: ' . $fundo[6] . ';
		color:	' . $letra[6] . ';
	}

	#botao_voltar {
		background-color: ' . $fundo[7] . ';
		color:	' . $letra[7] . ';
	}';

	file_put_contents('i_paleta.css', $saida);

}
?>