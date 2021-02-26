<?php



// recebe os parametros do html
$login		= $_POST['input_login'];
$senha1 	= $_POST['input_senha1'];
$senha2		= $_POST['input_senha2'];
$nome		= $_POST['input_nome'];
$telefone	= $_POST['input_telefone'];

$login_encript = password_hash($login, PASSWORD_DEFAULT);
$senha_encript = password_hash($senha1, PASSWORD_DEFAULT);
$login_encript = $login;
$senha_encript = $senha1;


include("i_conecta_usuarios.php");

$sql = "SELECT usuario
		 FROM $tb_usuarios 
		 WHERE usuario = '$login_encript'";

$result = $conn_usu->query($sql);

if ($result->num_rows > 0) {
		
	$saida  = "location: usu_inc.php?mensagem=Usuário já cadastrado";
	$saida .= "&login=".$login;
	$saida .= "&nome=".$nome;
	$saida .= "&telefone=".$telefone;

	header($saida);
	die();
}


if ($senha1 <> $senha2) {
	
	$saida  = "location: usu_inc.php?mensagem=Senhas diferentes";
	$saida .= "&login=".$login;
	$saida .= "&nome=".$nome;
	$saida .= "&telefone=".$telefone;

	header($saida);
	die();
}


// cria comando para inserir dados
$sql = "INSERT INTO $tb_usuarios (usuario, senha, nome, telefone)
					VALUES ('$login_encript','$senha_encript','$nome','$telefone')";

// executa e verifica resultado
if ($conn_usu->query($sql) === TRUE) {
	// fecha banco
	$conn_usu->close();

	header("location: msg_sucesso.php?destino='index.htm'");
	die();

} else {
	echo "Erro incluindo:" . $sql . "<br>" . $conn_usu->error;
	// fecha banco
	$conn_usu->close();
}

?>