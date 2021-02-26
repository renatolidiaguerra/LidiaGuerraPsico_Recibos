<!DOCTYPE html>
<html>
<head>
	<title>*** EXTRAÇÃO DE DADOS ***</title>
	<style>
	    table, th, td {
            border: 1px solid black;
        }
	    td {
            padding: 8px;
        }
		table {
			border-collapse: collapse;
			width: 100%;
			color: #588c7e;
			font-family: monospace;
			font-size: 18px;
			text-align: center;
		    border: 1px solid black;
		}
		th {
			background-color: #588c7e;
			color: white;
		    padding-top: 12px;
            padding-bottom: 12px;
		}
		tr:nth-child(even) {
		    background-color: #f2f2f2;
		}		
		tr:nth-child(odd) {
		    background-color: #ffffff;
		}
	</style>
</head>

<body>
	<table>
	<h2>*** EXTRAÇÃO DE DADOS ***<h2>
	<tr>
	     <th>ID RECIBO
	</th><th>CPF TITULAR
	</th><th>NOME TITULAR
	</th><th>DATA ENVIO
	</th><th>VALOR
	</th><th>OBSERVAÇÃO
	</th>
	</tr>
		<?php
		
		    session_start();
		    
        	$cod_user = $_SESSION['usuario'];
        	$dias     = $_GET['dias'];
        	
		    include("i_conecta_recibos.php");
		    include("i_conecta_clientes.php");
	        include("i_formata_cpf.php");
	        
	        setlocale(LC_TIME, 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
	

            if ($dias == 999) {
    	        $sql = "SELECT id, cpf_titular, cpf_dependente, data_envio,
	                           valor, observacao, status
			          	FROM  $tb_recibos
			    	    WHERE YEAR(data_envio) = YEAR(CURRENT_DATE) - 1
			    	      and cod_user = $cod_user
			    	      and status   = 1
			    	    ORDER BY data_envio";
            } else {
                if ($dias == 99) {
        	        $sql = "SELECT id, cpf_titular, cpf_dependente, data_envio,
    	                           valor, observacao, status
    			    	    FROM $tb_recibos
    			    	    WHERE YEAR(data_envio) = YEAR(CURRENT_DATE)
    			    	      and cod_user = $cod_user
    			    	      and status   = 1
    			    	    ORDER BY data_envio";
                } else {
        	        $sql = "SELECT id, cpf_titular, cpf_dependente, data_envio,
    	                           valor, observacao, status
    			    	    FROM $tb_recibos
    			    	    WHERE data_envio >= CURRENT_DATE - $dias
    			    	      and cod_user = $cod_user
    			    	      and status   = 1
    			    	    ORDER BY data_envio";
                }
            }

	        $result = $conn_rec->query($sql);
	
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				    
				    // ---------- pesquisa nome do cpf ----------

				    $cpf_titular = $row["cpf_titular"];
                    
                    $sql_tit = "SELECT nome
                    			FROM $tb_clientes
                    			WHERE cpf = '$cpf_titular'
                    			  AND cod_user = '$cod_user'";
                    
                    $result_tit = $conn_cli->query($sql_tit);
                    $dado_tit =  $result_tit->fetch_array();

				    // ---------- exibe em grade ----------

					echo "<tr><td>" 
					    . $row["id"]       .        "</td><td>" 
					    . mask($row["cpf_titular"],'###.###.###-##') .     
				"</td><td>"
					    . $dado_tit['nome'] .  
				"</td><td>"
					    . date_format(date_create($row['data_envio']),"d/m/Y") .
				"</td><td>"
					    . number_format($row['valor'], 2, ',', '.') . 
				"</td>
				    <td style= 'width:40%;'>"
					    . $row["observacao"] .      "</td>
					    </tr>";
				}
				echo "</table>";
			} else { 
			    ?> 
			    <h3> 
			    <?php 
			        echo "Nenhum resultado encontrado no período informado"; 
			        ?> 
			    </h3> 
			    <?php 
			}
			$conn_rec->close();
		?>
	</table>
	<br>
	<h2>
	    <a	href="dados.php">Voltar	</a>
	</h2>

</body>
</html>
