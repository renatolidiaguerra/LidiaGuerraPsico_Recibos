<?php

$paleta_fundo = array();
$paleta_letra = array();

$ind = 0;

//* branco: FFFFFF
//* preto : 000000

//*							 Hover		A		  B			C		  D			E		  OK		VOLTAR
$paleta_fundo[$ind] = array('#D8BFD8','#DDA0DD','#DA70D6','#EE82EE','#FF00FF','#BA55D3','#9400D3','#8B008B');
$paleta_letra[$ind] = array('#4B0082','#4B0082','#4B0082','#4B0082','#4B0082','#DDA0DD','#DDA0DD','#DDA0DD');  $ind++; /* rosa degrade */

$paleta_fundo[$ind] = array('#2c3e75','#94bfac','#5b9291','#3b6879','#264d7e','#1f3057','#2a283d','#3a73a9');
$paleta_letra[$ind] = array('#8cc5bb','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF');  $ind++; /* azul marinho degrade */

$paleta_fundo[$ind] = array('#196619','#85e085','#5cd65c','#33cc33','#248f24','#1f7a1f','#29a329','#145214');
$paleta_letra[$ind] = array('#ffffff','#000000','#000000','#000000','#000000','#FFFFFF','#FFFFFF','#FFFFFF');  $ind++; /* verde degrade */

$paleta_fundo[$ind] = array('#004d33','#633517','#a6001a','#e06000','#ee9600','#ffab00','#004d33','#00477e');
$paleta_letra[$ind] = array('#ffffff','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF');  $ind++; /* campo */

$paleta_fundo[$ind] = array('#FA6312','#E9EEA6','#DEEC14','#84AF2D','#4A8A49','#092D08','#FA6312','#FACC27');
$paleta_letra[$ind] = array('#000000','#000000','#000000','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#000000');  $ind++; /* floresta */

$paleta_fundo[$ind] = array('#D3D3D3','#E1ECF9','#609CE1','#236AB9','#133863','#091D34','#798EF6','#183BF0');
$paleta_letra[$ind] = array('#609CE1','#000000','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF');  $ind++; /* azul celeste degrade */

$paleta_fundo[$ind] = array('#C21460','#66B032','#347C98','#0247FE','#4424D6','#8601AF','#C21460','#FB9902');
$paleta_letra[$ind] = array('#000000','#000000','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF');  $ind++; /* alegria */

$paleta_fundo[$ind] = array('#000000','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF');
$paleta_letra[$ind] = array('#FFFFFF','#000000','#000000','#000000','#000000','#000000','#000000','#000000');  $ind++; /* contraste branco */

$paleta_fundo[$ind] = array('#FFFFFF','#000000','#000000','#000000','#000000','#000000','#000000','#000000');
$paleta_letra[$ind] = array('#000000','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF','#FFFFFF');  $ind++; /* contraste preto */


//* ---------------
$num_cores = count($paleta_fundo[0]);
$num_paleta = count($paleta_fundo);

$fundo_aux = array();
$letra_aux = array();

$paleta_fundo_string = array();
$paleta_letra_string = array();

//* ---------------
for ($paleta=0; $paleta < $num_paleta; $paleta++)
{
	
	for ($cor=0; $cor < $num_cores; $cor++)
	{
		$fundo_aux[$cor] = (int)base_convert(substr($paleta_fundo[$paleta][$cor],1,6), 16, 10);
		$letra_aux[$cor] = (int)base_convert(substr($paleta_letra[$paleta][$cor],1,6), 16, 10);
	}

	$paleta_fundo_string[$paleta] = serialize($fundo_aux);
	$paleta_letra_string[$paleta] = serialize($letra_aux);
}
	
?>