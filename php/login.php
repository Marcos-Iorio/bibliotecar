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
    
    if(!empty($arr) && password_verify($pass, $arr['contraseña'])){
        echo'<script type="text/javascript">
            alert("Inicio de sesión con éxito");
            </script>';
        echo'<script type="text/javascript">
            setTimeout(window.location.href="http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/inicio.html", 5000);
            </script>';
    }else{
        echo'<script type="text/javascript">
            alert("Credenciales erróneas");
            </script>';
        echo'<script type="text/javascript">
            setTimeout(window.location.href="http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/login.html", 5000);
            </script>';
            
        
    }
    
}else{
    echo "metodo no autorizado";
}

?>
