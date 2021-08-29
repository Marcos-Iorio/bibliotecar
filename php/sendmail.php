<!DOCTYPE html>
<html>
<head ><meta charset="UTF-8">



<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


function enviarMail(){
//Include required PHPMailer files
	require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';
//Define name spaces


	        
        if (isset($_POST['contactophp'])) {

        	if (isset($_POST['name']) && isset($_POST['email'])) {
        		$name = $_POST['name'] . " " . $_POST['last_name'];
        		$email = $_POST['email'];

            	$subject = "Se ha recibido una nueva consulta: ";
        		$body = "Consulta de: " . $name . " (" . $email . ") <br> <br>" . nl2br($_POST['body']); //nl2br permite los enters en el cuerpo del mail

         	}

        }


        if (isset($_POST['registrophp'])) {
                include 'ping.php';


       		if (isset($_POST['username']) && isset($_POST['mail'])) {
        		$name = $_POST['username'];
        		$email = $_POST['mail'];
                   	$subject = "Confirmacion de registro: Tu codigo de verificacion";
        	$body = "Hola " . $name . "! <br> <br> Gracias por registrarte. Por favor copia el codigo de abajo y pegalo en la pagina de verificacion. <br> <br> Tu codigo de verificacion es: " . "<b>".$d."<b>";
        	    cargarCodigo($d, $email);

         	}

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
			$mail->addAddress($email);

        }

	 //$mail->SMTPDebug = 6;
	 $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Finally send email

if ($mail->send()) {
            //$status = "success";
            //$response = "Email is sent!";
            if (isset($_POST['contactophp'])) {

    echo "<script>swal({title:'Exito',text:'Su consulta fue enviada. Nos estaremos poniendo en contacto con usted a la brevedad.',type:'success'});</script>";
    }
        } else {
            //$status = "failed";
            //$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
             echo "<script>swal({title:'Error',text:'Hubo un problema al enviar el mail. Por favor reintente o pongase en contacto con el soporte. Disculpe las molestias',type:'error'});</script>";
        }
	//Closing smtp connection
	$mail->smtpClose();
    
    //exit(json_encode(array("status" => $status, "response" => $response)));
   }


   function reenviar($name, $email, $pin){
//Include required PHPMailer files
    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'Exception.php';
//Define name spaces
            
            $subject = "Confirmacion de registro: Nuevo codigo de verificacion";
            $body = "Hola " . $name . "! <br> <br> Gracias por registrarte. Por favor copia tu nuevo codigo y pegalo en la pagina de verificacion. <br> <br> Tu nuevo codigo de verificacion es: " . "<b>".$pin."<b>";
                cargarCodigo($pin, $email);

        

        

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

            $mail->addAddress($email);


     //$mail->SMTPDebug = 6;
     $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Finally send email

if ($mail->send()) {
$flag='0';
        }
    //Closing smtp connection
    $mail->smtpClose();
    
    //exit(json_encode(array("status" => $status, "response" => $response)));
   }

?>

	<title></title>
</head>
<body>
</body>
</html>
