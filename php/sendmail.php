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
                cargarCodigo2($pin, $email);

        

        

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

   function enviarReserva($name, $email, $pin){
//Include required PHPMailer files
    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'Exception.php';
//Define name spaces
            
            $subject = "Confirmacion de reserva:";
            $body = "Hola " . $name . "! <br> <br> Te informamos que tu reserva fue ingresada con exito. Por favor guarda el codigo de abajo para poder retirar el libro al momento de presentarte en la institucion. <br> <br> Tu  codigo de reserva es: " . "<b>".$pin."<b>";
                //cargarCodigo2($pin, $email);

        

        

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
echo "<script>swal({title:'Exito',text:'Su reserva se ha realizado. Por favor verifica tu correo para mas informacion.',type:'success'});</script> ";
        } else {
           echo "<script>swal({title:'Atencion',text:'Su reserva se ha realizado pero no pudimos enviar el codigo de reserva a su correo. Por favor contacta al administrador para mas informacion.',type:'info'});</script> ";
 
        }
    //Closing smtp connection
    $mail->smtpClose();
    
    //exit(json_encode(array("status" => $status, "response" => $response)));
   }




    function enviarPwd($name, $email, $pin){
//Include required PHPMailer files
    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'Exception.php';
//Define name spaces
            
            $subject = "Usuario de BilbliotecAR creado correctamente";
            $body = "Bienvenido " . $name . "! <br> <br> Te informamos que tu usuario fue creado en nuestro sistema. Por favor accede al mismo utilizando tu mail y la contrasena de abajo. <br> <br> Tu contrasena es: " . "<b>".$pin."</b> <br> <br> Recorda cambiarla una vez ingresado al sistema.<br> <br>Saludos,<br> <b> Equipo BilbiotecAr";
                //cargarCodigo2($pin, $email);

        

        

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


// Recaptcha
require('vendor/autoload.php');

$dotenv = \Dotenv\Dotenv::createImmutable('./');
if(file_exists(".env")) {
    $dotenv->load();
}

/* $recaptcha = $_POST['g-recaptcha-response'];
$res = reCaptcha($recaptcha, $dotenv);
if(!$res['success']){
  // Error
} */

if(isset($_POST['g-recaptcha-response'])){
    echo verify($_POST['g-recaptcha-response']);
}

function verify($response){
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


/* function reCaptcha($recaptcha, $dotenv){

    $secret = getenv('SECRET_KEY');
    $ip = $_SERVER['REMOTE_ADDR'];
  
    $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);
  
    return json_decode($data, true);
  }
   */


?>

	<title></title>
</head>
<body>
</body>
</html>
