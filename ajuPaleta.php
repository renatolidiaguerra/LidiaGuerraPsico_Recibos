<?php
include('i_declara_paleta.php');
?>

<!DOCTYPE html>
<html>
<title>Emissor de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>

$(document).on('click', '.custom-clickable-row', function(e){

	var $entrada = $(this).data('href');

	var $url = 'grava_paleta_f.php?'.concat($entrada);

	window.location = $url;
	
});

</script>

<style>
.custom-clickable-row {
	cursor: pointer;
	height: 10em;
}
td {
	text-align: center;
}
</style>


<body>
	
	<div id="header_pagina">
		<h1>Paleta de Cores</h1>
	</div>
	
<div style="width: 100%; font-size: 3vw;">
	<table>
		
		<tr style="background-color: lightGray; color: black; height: 1em;">
			<td>_</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			<td>1</td>
			<td>0</td>
		</tr>
<!-- ------------------------------------ -->
<?php 
for ($paleta=0; $paleta < $num_paleta; $paleta++)
{ ?>
		<tr class="custom-clickable-row" data-href="<?php echo 'fundo='.$paleta_fundo_string[$paleta].'&letra='.$paleta_letra_string[$paleta]; ?>" >
		<?php for($cor=0; $cor < $num_cores; $cor++) { ?> 
			<td style="background-color: <?php echo $paleta_fundo[$paleta][$cor]; ?>; 
								  color: <?php echo $paleta_letra[$paleta][$cor]; ?>; "><?php echo "c:" . $cor . " p:" . $paleta; ?></td>
		<?php } ?>
		</tr>
<?php
}
?>
<!-- ------------------------------------ -->
	</table>
</div>	
	</table>
	<br>
	
	<a 	id="botao_voltar"	href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>
	
</body>
</html>