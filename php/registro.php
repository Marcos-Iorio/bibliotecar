<?php 


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include('db.php');

    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }

    if(isset($_POST['passwordRe'])){
        $pass = password_hash($_POST['passwordRe'], PASSWORD_DEFAULT);
    }

    if(isset($_POST['mail'])){
        $mail = $_POST['mail'];
    }
    
    #registrando al usuario
    $stmt = $dbh->prepare("INSERT INTO usuarios (nombre, mail, contraseña) VALUES (?, ?, ?)");
    // Bind
    $rol = 1;
    /* $id = 0;
    $stmt->bindParam(1, $id); */

    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $mail);
    $stmt->bindParam(3, $pass);

    // Execute
    if($stmt->execute()){
        echo "Se registro con exito";
        /* header('Location: http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/login.html'); */
    }

    
/* flags = false;
mailto($mail, "Confirmacion de mail");
function is_confirmed(){
    flags = true;
    echo "confirmacion aceptada"
} */

    function buscar_rol(){

        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }
    
        if(isset($_POST['passwordRe'])){
            $pass = password_hash($_POST['passwordRe'], PASSWORD_DEFAULT);
        }
    
        if(isset($_POST['mail'])){
            $mail = $_POST['mail'];
        }

        $rol = 1;
        $idUsuario;

        include('db.php');
        $stmt = $dbh->prepare("SELECT idUsuario FROM usuarios where mail = '". $mail . "'");
        $stmt->execute();


        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $row) {
           $idUsuario = $row['idUsuario'];
        }

        $stmt = $dbh->prepare("SELECT idRol FROM roles where idRol = '". $rol . "'");
        $stmt->execute();

        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $row) {
           $rol = $row['idRol'];
        }

    
      $stmt = $dbh->prepare("INSERT INTO usuarios_roles (idUsuario, idRol) VALUES (?, ?)");
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $rol);

        $stmt->execute();
    }
    buscar_rol();
}else{
    echo "metodo no autorizado";
}
?>