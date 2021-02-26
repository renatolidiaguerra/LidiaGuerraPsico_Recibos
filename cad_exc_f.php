<?php

include("i_conecta_clientes.php");

$getid = $_GET['id'];

$sel = "DELETE FROM $tb_clientes WHERE id = '$getid'";
$qry = mysqli_query($conn_cli, $sel);

if($qry) {
	header("location: msg_sucesso.php?destino='cad_exc.php'");
}

?>