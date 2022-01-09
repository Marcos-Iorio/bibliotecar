<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="../js/sweetalert2.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.css">
        <link rel="stylesheet" href="../css/login.css">


</head>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    function recuperacionPass($email) {
        include 'db.php';
     
        /* Busca los datos del usuario por el mail */
         $stmt = $dbh->prepare("SELECT * from usuarios where mail = '". $email . "'");
     
         $stmt->execute();

         $row = $stmt->fetch();
         if(!$row){
            echo "<script>swal({title:'Error',text:'El mail no se encuentra en nuestros registros, creá una cuenta primero.',type:'error'});</script> ";
         }else{     
             //Genera un token único
             $token = bin2hex(random_bytes(50));

             $stmt = $dbh->prepare('INSERT into password_recuperacion(email, token) VALUES (?, ?)');
             $stmt->bindParam(1, $email);
             $stmt->bindParam(2, $token);
     
             if($stmt->execute()){
                include 'sendmail.php';
                enviarRecuperacion($email, $token);
             }
         }
           
    }

    function actualizarPass(){
        include 'db.php';

        $token = $_GET['token'];

        /* Busca los datos del usuario por el mail */
        $stmt = $dbh->prepare("SELECT email from password_recuperacion where token = '". $token . "'");
     
        $stmt->execute();

        $email = $stmt->fetch(PDO::FETCH_ASSOC);

        if($email['email']){

            $nuevaPass = password_hash($_POST['nuevaPass'], PASSWORD_DEFAULT);

            $mail = $email['email'];

            $stmt = $dbh->prepare("UPDATE usuarios SET contrasena = '$nuevaPass' WHERE mail = '$mail'");

            // Ejecutamos
            if($stmt->execute()){
                echo '<script>swal({
                                title:"Éxito",text:"Tu contraseña se actualizó correctamente, vas a ser redirigido para que puedas iniciar sesión",
                                type:"success",
                                timer: 3000
                                });
                                setTimeout(function(){
                                    window.location.href = "../login.php";
                                 }, 3000);
                     </script> ';
            }else{
                echo "<script>swal({title:'Error',text:'Hubo un error en actualizar tu contraseña, contactá con el administrador',type:'error'});</script> ";
            }
        }
    }

}

?>