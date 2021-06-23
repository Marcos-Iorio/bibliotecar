<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('db.php');

    if(isset($_POST['mailL'])){
        $mail = $_POST['mailL'];
    }

    if(isset($_POST['passL'])){
        /* $pass = password_hash($_POST['passL'], PASSWORD_DEFAULT); */
        $pass = $_POST['passL'];
    }

    $stmt = $dbh->prepare('SELECT mail, contraseña from usuarios where mail = "' . $mail .'"');
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $pass . $arr['contraseña'];
    
    if(!empty($arr) && password_verify($pass, $arr['contraseña'])){
        echo "Ingreso exitosamente";
        header('Location: http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/inicio.html');
    }else{
        echo "Credenciales erronéas";
        
    }
    
}else{
    echo "metodo no autorizado";
}

?>
