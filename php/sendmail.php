<!DOCTYPE html>
<html lang="es">
<head >
<meta charset="UTF-8">
</head>
<body>
<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

function enviarMail(){
    /* iconv_set_encoding("internal_encoding", "UTF-8"); */
//Include required PHPMailer files
	require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';

    require('./vendor/autoload.php');

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
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

    
	$mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';
//Set mailer to use smtp

	$mail->isSMTP();
    /* $mail->SMTPDebug = SMTP::DEBUG_SERVER;  */  //Habilitar para debugear
//Define smtp host
	//$mail->Host = "smtp.office365.com";
		$mail->Host = "smtp.gmail.com";

//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	//$mail->SMTPSecure = "STARTTLS";
	$mail->SMTPSecure = "tls"; 

//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "soporte.bibliotecar@gmail.com";
//Set gmail password
	$mail->Password = $_ENV['PW_MAIL'];
//Email subject
    $mail->Subject = utf8_decode(("$subject $email"));
//Set sender email FROM
	$mail->setFrom($email);

//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = utf8_decode($body);
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

// Recaptcha
    if (isset($_POST['contactophp'])) {
        if(!empty($_POST['g-recaptcha-response'])){
            
            $secret = $_ENV['SECRET_KEY'];
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success == true){
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
                    echo $mail->ErrorInfo;
                    echo "<script>swal({title:'Error',text:'Hubo un problema al enviar el mail. Por favor reintente o pongase en contacto con el soporte. Disculpe las molestias',type:'error'});</script>";
                    }
                    //Closing smtp connection
                    $mail->smtpClose();
            }else{
                $message = "Error al verificar el recaptcha";
                echo $message;
            }
            //exit(json_encode(array("status" => $status, "response" => $response)));
        }
    }else{
        $mail->send();
    }
}


   function reenviar($name, $email, $pin){
    /* iconv_set_encoding("internal_encoding", "UTF-8"); */
    require('../vendor/autoload.php');

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $subject = "Confirmacion de registro: Nuevo codigo de verificacion";
    $body = "Hola " . $name . "! <br> <br> Gracias por registrarte. Por favor copia tu nuevo codigo y pegalo en la pagina de verificacion. <br> <br> Tu nuevo codigo de verificacion es: " . "<b>".$pin."<b>";
    
    cargarCodigo2($pin, $email);

//Create instance of PHPMailer
    $mail = new PHPMailer();
//Set mailer to use smtp
    $mail->isSMTP();
//Define smtp host
    //$mail->Host = "smtp.office365.com";
        $mail->Host = 'smtp.gmail.com'/* "smtp.gmail.com" */;

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
    $mail->Password = $_ENV['PW_MAIL'];
//Email subject
    $mail->Subject = utf8_decode(("$subject $email"));
//Set sender email FROM
    $mail->setFrom($email);

//Enable HTML
    $mail->isHTML(true);
//Attachment
    //$mail->addAttachment('img/attachment.png');
//Email body
    $mail->Body = utf8_decode($body);
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

   function enviarReserva($name, $email, $pin){
    /* iconv_set_encoding("internal_encoding", "UTF-8"); */

//Include required PHPMailer files
    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'Exception.php';
    require('./vendor/autoload.php');

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
//Define name spaces
    
    $subject = "Confirmacion de reserva:";
    $body = "Hola " . $name . "! <br> <br> Te informamos que tu reserva fue ingresada con exito. Por favor guarda el codigo de abajo para poder retirar el libro al momento de presentarte en la institucion. <br> <br> Tu  codigo de reserva es: " . "<b>".$pin."<b>";
        //cargarCodigo2($pin, $email);

//Create instance of PHPMailer
    $mail = new PHPMailer(true);
//Set mailer to use smtp
    $mail->isSMTP();
/*     $mail->SMTPDebug = SMTP::DEBUG_SERVER; */
//Define smtp host
    //$mail->Host = "smtp.office365.com";
        $mail->Host = "smtp.gmail.com";

//Enable smtp authentication
    $mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
    //$mail->SMTPSecure = "STARTTLS";
    $mail->SMTPSecure = "tls"; 

//Port to connect smtp
    $mail->Port = "587";
//Set gmail username
    $mail->Username = "soporte.bibliotecar@gmail.com";
//Set gmail password
    $mail->Password = $_ENV['PW_MAIL'];
//Email subject
    $mail->Subject = utf8_decode(("$subject $email"));
//Set sender email FROM
    $mail->setFrom($email);

//Enable HTML
    $mail->isHTML(true);
//Attachment
    //$mail->addAttachment('img/attachment.png');
//Email body
    $mail->Body = utf8_decode($body);
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
        echo "<script>swal({title:'??xito',type:'success', showConfirmButton: false, html: '<h6>Su reserva se ha realizado. Por favor verific?? tu correo para m??s informaci??n.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"libros.php\"><button class=\"btnFinalizarReserva\" type=\"submit\"  >OK</button></a>'});</script>";
    } else {
        echo "<script>swal({title:'Atenci??n',text:'Su reserva se ha realizado pero no pudimos enviar el codigo de reserva a su correo. Por favor contacta al administrador para m??s informaci??n.',type:'info'});</script> ";

    }
    //Closing smtp connection
    $mail->smtpClose();
    
    //exit(json_encode(array("status" => $status, "response" => $response)));
   }




    function enviarPwd($name, $email, $pin){
        /* iconv_set_encoding("internal_encoding", "UTF-8"); */
        require('./vendor/autoload.php');

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        //Include required PHPMailer files
            require 'PHPMailer.php';
            require 'SMTP.php';
            require 'Exception.php';
        //Define name spaces
                    
                    $subject ="Usuario de BilbliotecAR creado correctamente";
                    $body = "Bienvenido " . $name . "! <br> <br> Te informamos que tu usuario fue creado en nuestro sistema. Por favor acced?? al mismo utilizando tu mail y la contrase??a de abajo. <br> <br> Tu contrase??a es: " . "<b>".$pin."</b> <br> <br> Record?? cambiarla una vez ingresado al sistema.<br> <br>Saludos,<br> <b> Equipo BilbiotecAr";
                        //cargarCodigo2($pin, $email);

        //Create instance of PHPMailer
            $mail = new PHPMailer(true);
        //Set mailer to use smtp
            $mail->isSMTP();
        //Define smtp host
            //$mail->Host = "smtp.office365.com";
                $mail->Host = "smtp.gmail.com";

        //Enable smtp authentication
            $mail->SMTPAuth = true;
        //Set smtp encryption type (ssl/tls)
            //$mail->SMTPSecure = "STARTTLS";
            $mail->SMTPSecure = "tls"; 

        //Port to connect smtp
            $mail->Port = "587";
        //Set gmail username
            $mail->Username = "soporte.bibliotecar@gmail.com";
        //Set gmail password
            $mail->Password = $_ENV['PW_MAIL'];
        //Email subject
        $mail->Subject = utf8_decode(("$subject $email"));
        //Set sender email FROM
            $mail->setFrom($email);

        //Enable HTML
            $mail->isHTML(true);
        //Attachment
            //$mail->addAttachment('img/attachment.png');
        //Email body
            $mail->Body = utf8_decode($body);
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

function enviarRecuperacion($email, $token){
    /* iconv_set_encoding("internal_encoding", "UTF-8"); */

    require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';

    require('./vendor/autoload.php');

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    //Obtiene la url y la descomprime hasta obtener el relative path
    $link = $_SERVER['REQUEST_URI'];
    $link = explode("/", $link);
    $nuevoLink = "";
    foreach($link as $url){
        if(str_contains($url, '.php')){
            unset($url);
        }else{
            $nuevoLink .= $url . '/';
        }
    }

      
    $subject = "Recuperaci??n de la cuenta.";
    $body = "Hola, hace click en el siguiente <a href=\"http://localhost" . $nuevoLink . "olvide_mi_pass.php?token=" . $token . "\">link</a> para generar una nueva contrase??a en nuestro sitio";

    
    $mail = new PHPMailer();
    $mail->isSMTP();
    /* $mail->SMTPDebug = SMTP::DEBUG_SERVER; */
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "TLS"; 
    $mail->Port = "587";
    $mail->Username = "soporte.bibliotecar@gmail.com";
    $mail->Password = $_ENV['PW_MAIL'];
    $mail->Subject = utf8_decode(("$subject $email"));;
    $mail->setFrom($email);
    $mail->isHTML(true);
    $mail->Body = utf8_decode($body);
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
        echo "<script>Swal.fire({title:'Exito',text:'Hemos enviado un mail de recuperaci??n a tu correo, si no lo encontr??s, verific?? la casilla de SPAM.',type:'success'});</script> ";
    }else{
        echo "<script>Swal.fire({title:'Atencion',text:'Su solicitud de cambio de contrase??a se ha procesado con exito pero por alguna raz??n no hemos podido enviar el mail, por favor contacta con el administrador del sitio.',type:'info'});</script> ";
    }
    //Closing smtp connection
    $mail->smtpClose();

}

function verify($response){
    require('vendor/autoload.php');

    $dotenv = \Dotenv\Dotenv::createImmutable('./');
    if(file_exists(".env")) {
        $dotenv->load();
    }

  $ip = $_SERVER['REMOTE_ADDR'];
  $key = getenv('SECRET_KEY');
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $full_url = $url.'?secret='.$key.'&response='.$response.'&remoteip='.$ip;

  $data = json_decode(file_get_contents($full_url));
  if(isset($data->success) && $data->success == true){
     return true;
  }
  return false;
}

?>
</body>
</html>
