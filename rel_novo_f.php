<?php

session_start();

$cpf_titular 	= $_POST['input_cpf_titular'];
$nome_titular	= $_POST['input_nome_titular'];
$data_envio		= $_POST['input_data_envio'];
$cidx			= $_POST['input_cidx'];
$conteudo		= $_POST['input_conteudo'];

$cod_user = $_SESSION['usuario'];

include("i_conecta_relatorios.php");
include("i_crypto.php");

//*  concatena texto com variavel preenchida
$aux_cidx = 'CIDX nº: ' . $cidx;
//*  troca todo fixo CIDX por CIDX+variavelpreenchida dentro de 'conteudo'
$aux_conteudo = str_replace('CIDX',$aux_cidx, $conteudo);
//* volta aux_conteudo para conteudo, já finalizado
$conteudo = $aux_conteudo;
//* 

$sql = "INSERT INTO $tb_relatorios (cod_user, cpf_titular, data_envio, cidx, conteudo)
					VALUES (´$cod_user`,´$cpf_titular`,´$data_envio`,´$cidx`,´$conteudo`)";

//* executa e verifica resultado
if ($conn_rel->query($sql) === TRUE) 
	{
	//* captura id do ultimo registro incluido
	$ultimo_id = $conn_rel->insert_id;
	
	//* cria chave criptografada com dados + id do registro do recibo
	$cryptokey = crypto("[" . $cpf_titular . "|" . $data_envio . "|" . $conteudo . "|" . $ultimo_id . "]");
	$cryptokey = "[" . $cpf_titular . "|" . $data_envio . "|" . $conteudo . "]";
	$sql = "UPDATE 	$tb_relatorios
					SET cryptokey = '$cryptokey' 
					WHERE id = '$ultimo_id'";
					
	if ($conn_rel->query($sql) === TRUE) {	
		// fecha banco
		$conn_rel->close();

		//* chama emissor de recibo para ultimo criado
		header("location: rel_emit.php?id=" . $ultimo_id );
	} else {
		echo "Erro incluindo:" . $sql . "<br>" . $conn_rel->error;
		// fecha banco
		$conn_rel->close();
	}
	
} else {
	echo "Erro incluindo:" . $sql . "<br>" . $conn_rel->error;
	// fecha banco
	$conn_rel->close();
}

?>