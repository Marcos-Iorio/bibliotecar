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

    #chequea si el mail ya esta registrado
    $stmt = $dbh->prepare("SELECT 1 from usuarios where mail ='". $mail ."' LIMIT 1");
    // Ejecutamos
    $stmt->execute();
    // recorremos las filas en busca del mail
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($arr)){
            #registrando al usuario
        $stmt = $dbh->prepare("INSERT INTO usuarios (idEstado, idRol, nombre, mail, contraseña) VALUES (?, ?, ?, ?, ?)");
        // Bind
        $rol = 1;
        $idEstado = 1;

        $stmt->bindParam(3, $username);
        $stmt->bindParam(4, $mail);
        $stmt->bindParam(5, $pass);
        $stmt->bindParam(2, $rol);
        $stmt->bindParam(1, $idEstado);

        // Execute
        if($stmt->execute()){
            echo "Se registro con exito";
            header('Location: http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/login.html');
        }else{
            echo "Error";
        }
    }else{
        echo('El mail ya esta siendo utilizado');
        /* header('Location: http://localhost/Practica%20Profesionalizante/Proyecto%20final/html/login.html'); */
     }

}else{
    echo "Metodo no autorizado";
}
?>