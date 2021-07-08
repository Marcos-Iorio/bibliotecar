<?php
session_start(); //starting the session for user profile page
?>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('db.php');

    if(isset($_POST['mailL']) && isset($_POST['passL'])){
        $mail = $_POST['mailL'];
        //$_SESSION['loggedin'] = true;
        $pass = $_POST['passL'];

    }

    $stmt = $dbh->prepare('SELECT idRol, contrasena, nombre from usuarios where mail = "' . $mail .'" LIMIT 1');
    // Ejecutamos
    $stmt->execute();

    // Mostramos los resultados
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($arr['idRol']){

        if(!empty($arr) && password_verify($pass, $arr['contrasena'])){
           /* echo'<script type="text/javascript">
                alert("Inicio de sesión con éxito");
                </script>'; */
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $arr['nombre'];
                    $_SESSION['mailL'] = $_POST['mailL'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + 3600;
                    $_SESSION['rol'] = $arr['idRol'];


            echo'<script type="text/javascript">
                setTimeout(window.location.href="../", 5000);
                </script>';
        }else{
            echo'<script type="text/javascript">
                alert("Credenciales erróneas");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.php", 5000);
                </script>';  
        }
    }

    /* elseif($arr['idRol'] === '2'){

        if(!empty($arr) && password_verify($pass, $arr['contrasena'])){
            echo'<script type="text/javascript">
                alert("Inicio de sesión con éxito");
                </script>';
                  session_start(); //starting the session for user profile page

            echo'<script type="text/javascript">
                setTimeout(window.location.href="../colaborador/inicioColab.php", 5000);
                </script>';
        }else{
            echo'<script type="text/javascript">
                alert("Credenciales erróneas");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.html", 5000);
                </script>';  
        }
    }elseif($arr['idRol'] === '3'){

        if(!empty($arr) && password_verify($pass, $arr['contrasena'])){
            echo'<script type="text/javascript">
                alert("Inicio de sesión con éxito");
                </script>';
                        session_start(); //starting the session for user profile page

            echo'<script type="text/javascript">
                setTimeout(window.location.href="../administrador/inicioAdmin.php", 5000);
                </script>';
        }else{
            echo'<script type="text/javascript">
                alert("Credenciales erróneas");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.html", 5000);
                </script>';  
        }
    }else{
        echo'<script type="text/javascript">
                alert("Usuario no registrado!");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.html", 5000);
                </script>';  
    }*/ 

    
}else{
    echo "metodo no autorizado";
}

?>
