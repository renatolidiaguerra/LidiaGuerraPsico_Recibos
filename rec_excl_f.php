<?php

include("i_conecta_recibos.php");

$getid = $_GET['id'];

# $sel = "DELETE FROM $tb_recibos WHERE id = '$getid'";

$sel = "UPDATE $tb_recibos 
          SET status = 0 
          WHERE id = '$getid'";

$qry = mysqli_query($conn_rec, $sel);

if($qry) {
	header("location: msg_sucesso.php?destino='rec_pesq.php'");
}

?>