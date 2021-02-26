<?php

session_start();

$cpf_titular 	= $_POST['input_cpf_titular'];
$nome_titular	= $_POST['input_nome_titular'];
$cpf_dependente = $_POST['input_cpf_dependente'];
$data_envio		= $_POST['input_data_envio'];
$valor			= $_POST['input_valor'];
$observacao		= $_POST['input_observacao'];
$status         = 1;

$cod_user = $_SESSION['usuario'];

include("i_conecta_recibos.php");
include("i_crypto.php");

$sql = "INSERT INTO $tb_recibos (cod_user, cpf_titular, cpf_dependente, valor, data_envio, observacao, status)
					VALUES ('$cod_user','$cpf_titular','$cpf_dependente','$valor','$data_envio','$observacao','$status')";

//* executa e verifica resultado
if ($conn_rec->query($sql) === TRUE) 
	{
	//* captura id do ultimo registro incluido
	$ultimo_id = $conn_rec->insert_id;
	
	//* cria chave criptografada com dados + id do registro do recibo
	$cryptokey = crypto("[" . $cpf_titular . "|" . $cpf_dependente . "|" . $data_envio . "|" . $valor . "|" . $observacao . "|" . $ultimo_id . "]");
	$cryptokey = "[" . $cpf_titular . "|" . $cpf_dependente . "|" . $data_envio . "|" . $valor . "|" . $observacao . "]";
	$sql = "UPDATE 	$tb_recibos 
					SET cryptokey = '$cryptokey' 
					WHERE id = '$ultimo_id'";
					
	if ($conn_rec->query($sql) === TRUE) {	
		// fecha banco
		$conn_rec->close();

		//* chama emissor de recibo para ultimo criado
		header("location: rec_emit.php?id=" . $ultimo_id );
	} else {
		echo "Erro incluindo:" . $sql . "<br>" . $conn_rec->error;
		// fecha banco
		$conn_rec->close();
	}
	
} else {
	echo "Erro incluindo:" . $sql . "<br>" . $conn_rec->error;
	// fecha banco
	$conn_rec->close();
}

?>