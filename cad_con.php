<?php
session_start();
?>

<!DOCTYPE html>
<html>
<title>Gerador de Recibos</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="i_style.css">

<body>

	<div id="header_pagina">
	  <h1>Consulta Cliente</h1>
	</div>
	
	<?php
	include("i_conecta_clientes.php");
	$cod_user = $_SESSION['usuario'];
	
	$sql = "SELECT id, cpf, nome, endereco, datanascimento, email, telefone, cpf_titular 
			  FROM $tb_clientes 
			  WHERE cod_user = '$cod_user'
			  ORDER BY nome";
	$result = $conn_cli->query($sql);

	if ($result->num_rows > 0) {
		echo 	"<table>
					<tr>
						<th>ID		</th>
						<th>Nome	</th>
						<th>CPF		</th>
						<th>Endereco</th>
						<th>Email	</th>
						<th>Data Nasc.	</th>
						<th>Telefone	</th>
						<th>CPF Titular	</th>
					</tr>";
					
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo 	"<tr>
						<td>" . $row["id"]  . "</td>
						<td>" . $row["nome"] . "</td>
						<td>" . mask($row["cpf"],'###.###.###-##') . "</td>
						<td>" . $row["endereco"]. "</td>
						<td>" . $row["email"]. "</td>
						<td>" . date('d/m/Y', strtotime($row["datanascimento"])) . "</td>
						<td>" . $row["telefone"]. "</td>
						<td>" . mask($row["cpf_titular"],'###.###.###-##') . "</td>
					</tr>";
		}
		echo "</table>";
	} else {
		?>
		<div id="botao_e">
			Nenhum nome encontrado
		</div> 
		<?php
	}

	$conn_cli->close();
	
	//* formata CPF
	function mask($val, $mask)
		{
		if ($val == null)
				return "";
			
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
			{
			if($mask[$i] == '#')
				{
				if(isset($val[$k]))
					$maskared .= $val[$k++];
				}
			else
				{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
				}
			}
		return $maskared;
		}
	?> 

	<a 	id="botao_voltar"
		href="cad.php">

		<i class="material-icons w3-xxlarge w3-cell-middle w3-left">home</i>
		Voltar
	</a>

</body>
</html>