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
    $stmt = $dbh->prepare("SELECT 1 from usuarios where mail =?");
    $stmt->bindParam(1, $mail);

    // Ejecutamos
    $stmt->execute();
      
    // recorremos las filas en busca del mail
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($arr)){

            #registrando al usuario
        $stmt = $dbh->prepare("INSERT INTO usuarios (idEstado, idRol, nombre, mail, contrasena) VALUES (?, ?, ?, ?, ?)");
        // Bind
        $rol = 1;
        $idEstado = 1;


        $stmt->bindParam(3, $username);
        $stmt->bindParam(4, $mail);
        $stmt->bindParam(5, $pass);
        $stmt->bindParam(2, $rol);
        $stmt->bindParam(1, $idEstado);

      //print_r($stmt);
        // Execute
        
        if($stmt->execute()){
            echo'<script type="text/javascript">
                alert("Registro con éxito");
                </script>';
            echo'<script type="text/javascript">
                setTimeout(window.location.href="../html/login.php", 5000);
                </script>';
        }else{
            echo "Error";
        }
    }else{
        echo'<script type="text/javascript">
            alert("El mail ya está siendo utilizado");
            </script>';
        echo'<script type="text/javascript">
            setTimeout(window.location.href="../html/login.php", 5000);
            </script>';
     }

}else{
    echo "Metodo no autorizado";
}
?>