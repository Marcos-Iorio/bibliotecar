<?php

//Include required PHPMailer files
	require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'] . " " . $_POST['last_name'];
        $email = $_POST['email'];
        
        if (isset($_POST['contactophp'])) {
        	$subject = "Se ha recibido una nueva consulta: ";
        	$body = "Consulta de: " . $name . " (" . $email . ") <br> <br>" . nl2br($_POST['body']); //nl2br permite los enters en el cuerpo del mail
        }

        if (isset($_POST['registrophp'])) {
        	$subject = "Confirmacion de registro!";
        	$body = "Hola " . $name . "! <br> <br> Gracias por registrarte. Por favor hace click en el enlace de abajo para confirmar tu mail";
        }

//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	//$mail->Host = "smtp.office365.com";
		$mail->Host = "smtp.gmail.com";

//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	//$mail->SMTPSecure = "STARTTLS";
	$mail->SMTPSecure = "TLS"; 

//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "soporte.bibliotecar@gmail.com";
//Set gmail password
	$mail->Password = "bibliotecar123";
//Email subject
	$mail->Subject = ("$subject $email");
//Set sender email FROM
	$mail->setFrom($email);

//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = $body;
//Add recipient TO:
        if (isset($_POST['contactophp'])) {
			$mail->addAddress('soporte.bibliotecar@gmail.com');
        }

        if (isset($_POST['registrophp'])) {
			$mail->addAddress('aca va mail de usuario');

        }

	 $mail->SMTPDebug = 6;
	 $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Finally send email
if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
	//Closing smtp connection
	$mail->smtpClose();
    exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
