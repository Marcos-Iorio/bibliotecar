<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('db.php');

    if(isset($_POST['mailL'])){
        $mail = $_POST('mailL');
    }

    if(isset($_POST['passL'])){
        $pass = password_hash($_POST('passL'), PASSWORD_DEFAULT);
        echo $pass;
    }

    $stmt = $dbh->prepare("SELECT mail from usuarios where mail = '" . $mail . "' and contraseña = '" . $pass . "' LIMIT 1 ");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()){
        if($row[mail] == $mail && password_verify($pass, $row[contraseña])){
            echo "Ingreso exitosamente";
            header('Location: http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/inicio.html');
        }else{
            echo "Credenciales erronéas";
        }
    }
}else{
    echo "metodo no autorizado";
}

?>