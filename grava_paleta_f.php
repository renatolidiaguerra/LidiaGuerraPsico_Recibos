<?php 

	$fundo_s = $_GET["fundo"];
	$letra_s = $_GET["letra"]; 

	$fundo = unserialize($fundo_s);
	$letra = unserialize($letra_s);
	
	$saida = '
	#botao_a:hover, 
	#botao_b:hover, 
	#botao_c:hover, 
	#botao_d:hover, 
	#botao_e:hover, 
	#botao_ok:hover, 
	#botao_voltar:hover {
		background-color: #' . converte($fundo[0],10,16) . ';
		color: #' . converte($letra[0],10,16) . ';
	}

	#botao_a {
		background-color: #' . converte($fundo[1],10,16) . ';
		color: #' . converte($letra[1],10,16) . ';
	}

	#botao_b {
		background-color: #' . converte($fundo[2],10,16) . ';
		color: #' . converte($letra[2],10,16) . ';
	}

	#botao_c {
		background-color: #' . converte($fundo[3],10,16) . ';
		color: #' . converte($letra[3],10,16) . ';
	}

	#botao_d {
		background-color: #' . converte($fundo[4],10,16) . ';
		color: #' . converte($letra[4],10,16) . ';
	}

	#botao_e {
		background-color: #' . converte($fundo[5],10,16) . ';
		color: #' . converte($letra[5],10,16) . ';
	}

	#botao_ok {
		background-color: #' . converte($fundo[6],10,16) . ';
		color: #' . converte($letra[6],10,16) . ';
	}

	#botao_voltar {
		background-color: #' . converte($fundo[7],10,16) . ';
		color: #' . converte($letra[7],10,16) . ';
	}
	
	#header_pagina {
		background-color: #' . converte($fundo[7],10,16) . ';
		color: #' . converte($letra[7],10,16) . ';
		text-align: left;
		width: 100%;
		display: inline-block;
		text-decoration: none;
		border-bottom: 2px solid #' . converte($fundo[6],10,16) . ';
	}
	
	#header_sucesso {
		background-color: #' . converte($fundo[6],10,16) . ';
		color: #' . converte($letra[6],10,16) . ';
	}	
	
	table tr:nth-child(even) {
		background-color: #' . converte($fundo[2],10,16) . ';
		color: #' . converte($letra[2],10,16) . ';
	}
	}
	table tr:nth-child(odd) {
		background-color: #' . converte($fundo[4],10,16) . ';
		color: #' . converte($letra[4],10,16) . ';
	}
	table th {
		background-color: #' . converte($fundo[6],10,16) . ';
		color: #' . converte($letra[6],10,16) . ';
	}
	table tr:hover	{
		background-color: #' . converte($fundo[0],10,16) . ';
		color: #' . converte($letra[0],10,16) . ';
	}
	
	
	input[type=text], 
	input[type=email], 
	input[type=date], 
	input[type=password],
	input[type=number],
	textarea,
	select {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #' . converte($fundo[6],10,16) . ';
		border-radius: 4px;
		box-sizing: border-box;
		font-family: Arial;
		font-size: 20px;
	}
	
	table, th, td {
		border: 1px solid Black;
		border-collapse: collapse;
	}

	table {
		width:100%;
	}
	th, td {
		padding: 15px;
		text-align: left;
	}

	/* ------------------------------- */
	/* CAMPOS INPUT INCLUSAO-ALTERAÇÃO */
	/* ------------------------------- */
	input:focus {
		background-color: WhiteSmoke;
	}

	input:-moz-read-only {
		background-color: WhiteSmoke;
		color: Gray;
	}
	input:read-only {
		background-color: WhiteSmoke;
		color: Gray;
	}

	h1 {
		font-size: 1.5em;
		padding-left: 2em;
	}

	#botao_a, #botao_b, #botao_c, #botao_d, #botao_e, #botao_ok, #botao_voltar {
		padding: 0.7em;
		text-align: center;
		font-size: 1.5em;
		width: 100%;
		display: inline-block;
		text-decoration: none;
	}
	
	
	';

	file_put_contents('i_paleta.css', $saida);

	header("Refresh:0; url=aju.php");

function converte($valor, $origem, $destino) {

	$result = base_convert($valor, $origem, $destino);
	$result = str_pad($result, 6, "0", STR_PAD_LEFT);
	
	return $result;
}
?>