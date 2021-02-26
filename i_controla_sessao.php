<?php



function existe_sessao() {
	
	if (isset($_SESSION['usuario'])) {
		exibe("CS:Existe Sessao");
	} else {
		exibe("CS:Nao existe sessao aberta");
	}
	
	return isset($_SESSION['usuario']);

}

function cria_sessao($sessao_valor) {
	
	session_destroy();
	
	session_start();
	$_SESSION['usuario'] = $sessao_valor;
	exibe ("CS:criando sessao");	
}

function deleta_sessao() {

	session_destroy();
exibe("CS:deletando sessao");
}

?>