<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

date_default_timezone_set('Etc/UTC');

//* parametros: from, to, msg, arq

/*
$de_email	= $_POST['de_email'];
$de_nome	= $_POST['de_nome'];
$para_email	= $_POST['para_email'];
$para_nome	= $_POST['para_nome'];
$corpo  	= $_POST['corpo'];
$titulo		= $_POST['titulo'];
$arquivo	= $_POST['arquivo'];
*/

$mail = new PHPMailer(true);             // Passing `true` enables exceptions
try {
    //Server settings
	
    $modo = 'site';
    
    if ($modo != 'site')
    {
        echo 'nao eh site';
    	$servidor = 'smtp.gmail.com';
    	$username = 'lidiarenato10@gmail.com';
    	$password = "gb240820";
    	$porta    = 587;
        $SMTPAuth = true;
        $SMTPSecure = 'tls';
        $para_bcc = $de_email;
    } else {
        echo 'site' . "<br>";
    	$servidor = 'relay-hosting.secureserver.net';
    	$username = '';
        $password = '';
        $porta    = 25;
        $SMTPAuth = false;
        $SMTPSecure = false;
        $de_email = 'warlidia@icloud.com';
        $para_bcc = 'warlidia@hotmail.com';
       }
    
    $mail->SMTPDebug = 2;               // Enable verbose debug output (0;2)
    $mail->isSMTP();                    // Set mailer to use SMTP
    $mail->Host = $servidor;  			// Specify main and backup SMTP servers
    $mail->SMTPAuth = $SMTPAuth;        // Enable SMTP authentication
    $mail->Username = $username; 		// SMTP username
    $mail->Password = $password;        // SMTP password
    $mail->SMTPSecure = $SMTPSecure;    // Enable TLS encryption, `ssl` accepted
    $mail->Port = $porta;               // TCP port to connect to

    //Recipients
    $mail->setFrom($de_email, $de_nome);
    $mail->addAddress($para_email, $para_nome);     // Add a recipient
//    $mail->addAddress('ellen@example.com');       // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
    $mail->addBCC($para_bcc);

    //Attachments
    $mail->addAttachment($arquivo, 'Recibo Eletronico ' . $dado_tit['cpf'] . "_" . $dado_rec['id'] . "_" . $dado_rec['data_envio'] . ".pdf");         // Add attachments

    //Content
    $mail->isHTML(true);                // Set email format to HTML
    $mail->Subject = $titulo;
    $mail->Body    = $corpo;
    $mail->AltBody = $corpo;

    $mail->send();
	
    header("location: msg_sucesso.php?destino='rec_pesq.php'");
	
} catch (Exception $e) {
    echo 'A mensagem nao pode ser senviada. Erro: ', $mail->ErrorInfo;
}