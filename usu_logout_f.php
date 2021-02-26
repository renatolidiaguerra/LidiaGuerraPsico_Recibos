<?php

session_start();

include ('i_print.php');
include ('i_controla_cookie.php');
include ('i_controla_sessao.php');

deleta_cookie();

deleta_sessao();

header("location: index.htm");
	
?>