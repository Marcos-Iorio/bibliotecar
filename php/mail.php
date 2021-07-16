<?php

    include('db.php');
    include('registro.php');

    $url = "../php/confirmacion.php";

    $msg = "Porfavor confirma tu mail haciendo click en el link de abajo!\n 
           . $url .\n Este correo fue enviado de forma automatica, por favor, no lo respondas\n
            web@bibliotecar.com.";
            
    $subject = "Confirmacion de mail";

    $from = "From:  web@bibliotecar.com" . "\r\n";

    $to = $mail;

    mail($to, $subject , $msg, $from);
?>