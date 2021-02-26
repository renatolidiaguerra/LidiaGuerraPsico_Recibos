<?php
//* ---------------------------
//* criptografa string recebida
//* ---------------------------

function crypto ($entrada)
	{
	
	$reverso = strrev($entrada);
	
	$reverso .= date('YmdHis');
	
	$zipado = gzdeflate($reverso,9);
	
	$base64_2 = base64_encode($zipado);
	
	return gzdeflate($base64_2,9);
	}

function decrypto ($entrada)
	{
	$lap1 = gzinflate($entrada);
	
	$base64_2 = base64_decode($lap1);
	
	$zipado = gzinflate($base64_2);
	
	$tam = strlen($zipado);
	
	$timestamp = substr($zipado,$tam - 14, 14);
	
	$zipado = substr($zipado,0,$tam - 14);
	
	$lap2 = strrev($zipado);
	
	return $lap2 . "[TIMESTAMP:" . $timestamp . " ]";
	}

function cryptox ($entrada)
	{
	$zipado = gzcompress($entrada,9);

	$base64 = base64_encode($zipado);
		
	$reverso = strrev($base64);
	
	$reverso .= date('YmdHis');
	
	$base64_2 = base64_encode($reverso);
	
	return gzcompress($base64_2,9);
	}
?>