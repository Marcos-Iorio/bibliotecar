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

    $stmt = $dbh->prepare('SELECT idRol, contraseña from usuarios where mail = "' . $mail .'" LIMIT 1');
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    

        if(!empty($arr) && password_verify($pass, $arr['contraseña'])){
            echo'<script type="text/javascript">
                alert("Inicio de sesión con éxito");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../php/inicio.php", 5000);
                </script>';
        }else{
            echo'<script type="text/javascript">
                alert("Credenciales erróneas");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.html", 5000);
                </script>';  
        }
        if(empty($arr)){
        echo'<script type="text/javascript">
                alert("Usuario no registrado!");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.html", 5000);
                </script>';  
        }   
    }else{
            echo "metodo no autorizado";
        }

?>
