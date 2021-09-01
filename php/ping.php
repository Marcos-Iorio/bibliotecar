<!DOCTYPE html>
<html>
<head>
	<title></title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="../js/sweetalert2.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.css">
        <link rel="stylesheet" href="../css/login.css">
</head>
<body>


<?php
  include "islogin.php";

	if(isset($_POST['mail'])){
        $mail = $_POST['mail'];
		$_SESSION['email'] = $mail;


  $d=mt_rand(1,999999);
  while(strlen($d) < 6 && strlen($d)){
    $d=mt_rand(1,999999);
  }

    }

function cargarCodigo($codigo, $mail){

	include('db.php');

		echo $codigo;
		echo $mail;


	$stmt = $dbh->prepare("Update usuarios set ping='".$codigo."' where mail = ?");
    $stmt->bindParam(1, $mail);

    // Ejecutamos
        if($stmt->execute()){
        	echo '<script>swal({
    title:"Exito",
    text:"",
    type: "success",
    html:\'<form method="POST" action="../php/ping.php" style="height:50%;"><br><h5>Te enviamos un codigo a tu mail. Ingresalo debajo para confirmar tu usuario.</h5><br><input name="codigoIngresado" style="width: 180px; font-size: 36px; color: black; font-weight: bold; text-align: center;" type="text" required; maxlength = "6";"/><br> <div> <input type="submit" style="background-color: #495F91; color:white; width: 150px;" name="confirmarCodigo" value="Confirmar"><br><input type="submit" style="background-color: gray; color:white; width: 150px;" name="reenviarCodigo" value="Reenviar codigo"></div><br><br></form>\',
   showCancelButton: false,
      showConfirmButton: false,

    cancelButtonColor: "gray",
    confirmButtonColor: "#495F91",

    width: 500,
    padding: "3em"

});</script>  
 ';

  

}

}


 if(isset($_POST['reenviarCodigo'])){

	reenviarCodigo();
} 


function reenviarCodigo(){

$mail = $_SESSION['email'];

	$codigo=mt_rand(1,999999);
  		while(strlen($codigo) < 6 && strlen($codigo)){
    $codigo=mt_rand(1,999999);
  }

include('db.php');

        	$stmt = $dbh->prepare("Select nombre, mail from usuarios where mail = ?");
    		$stmt->bindParam(1, $mail);
    		if ($stmt->execute()) {
    			$arr = $stmt->fetch(PDO::FETCH_ASSOC);
        	    $nombre = $arr['nombre'];
        	    $mail = $arr['mail'];
    		}

    		include "sendmail.php";
    		reenviar($nombre, $mail, $codigo);
        	    
 		//include('sendmail.php');
        // enviarMail();


}



  if(isset($_POST['confirmarCodigo']) && isset($_POST['codigoIngresado'])){
  	$pin = $_POST['codigoIngresado'];
  	 $email=$_SESSION['email'];
confirmarMail($pin, $email);
} 

function confirmarMail($codigo, $mail){
	
        		include "registro.php";

	include('db.php');

	$stmt = $dbh->prepare("Select ping from usuarios where mail = ?");
    $stmt->bindParam(1, $mail);


////// Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);

    if($arr['ping'] == $codigo){
    	$stmt = $dbh->prepare("Update usuarios set checkMail = '1' where mail = ?");
    	$stmt->bindParam(1, $mail);

///////Hasta aca falla


		if ($stmt->execute()) {
			echo '
                <script>swal({
    title:"Usuario registrado!",
    text:"",
    type: "success",
    html:\'<form method="POST" action="../" style="height:50%;"><br><h5>Tu mail y usuario fueron registrados correctamente. Ya podes empezar a usar el portal.</h5><br> <div> <input type="submit" style="background-color: #495F91; color:white; width: 150px;" name="volverInicio" value="Pagina principal"></div><br><br></form>\',
   showCancelButton: false,
      showConfirmButton: false,

    cancelButtonColor: "gray",
    confirmButtonColor: "#495F91",

    width: 500,
    padding: "3em"

});</script>';

session_destroy();
        } 

        } else {
       	echo '
                <script>swal({
    title:"Error!",
    text:"",
    type: "error",
    html:\'<form method="POST" action="../php/ping.php" style="height:50%;"><br><h5>El codigo ingresado no coincide con el enviado. Por favor reintenta o reenvia un nuevo codigo.</h5><br> <input name="codigoIngresado" style="width: 180px; font-size: 36px; color: black; font-weight: bold; text-align: center;" type="text" required; maxlength = "6";"/><br> <div> <input type="submit" style="background-color: #495F91; color:white; width: 150px;" name="confirmarCodigo" value="Confirmar"><br><input type="submit" style="background-color: gray; color:white; width: 150px;" name="reenviarCodigo" value="Reenviar codigo"></div><br><br></form>\',
   showCancelButton: false,
      showConfirmButton: false,

    cancelButtonColor: "gray",
    confirmButtonColor: "#495F91",

    width: 500,
    padding: "3em"

});</script>';

		}

		
       	
				

}



?>


</body>



</html>



