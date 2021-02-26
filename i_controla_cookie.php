<?php

function cria_cookie($cookie_valor) {

	$tempo_cookie = 86400 * 30;
	$cookie_nome = "usuario";

	setcookie($cookie_nome, $cookie_valor, time() + ($tempo_cookie), "/");    //(86400 * 30), "/"); // 86400 = 1 day
	exibe("CC:Criando cookie");
	exibe($cookie_valor);

}

function existe_cookie() {

	if (isset($_COOKIE) & isset($_COOKIE['usuario'])) {
		exibe("CC:Cookie ok");
		return true;
	} else {
		exibe("CC:Cookie nao existe");
		return false;
	}
}

function deleta_cookie() {
	
	$cookie_nome = "usuario";
	$cookie_valor = "";
	
	setcookie($cookie_nome, $cookie_valor, time() - (3600), "/"); 
	exibe("CC:deletando cookie");
}
?>