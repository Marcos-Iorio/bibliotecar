<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="../js/sweetalert2.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.css">
        <link rel="stylesheet" href="../css/login.css">


</head>


<?php 


function registrarUsuario(){

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include('db.php');
    //include('../js/mensajes.js');

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
    $stmt = $dbh->prepare("SELECT 1 from usuarios where mail = ?");
    $stmt->bindParam(1, $mail);

    // Ejecutamos
    $stmt->execute();
      
    // recorremos las filas en busca del mail
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($arr)){ 

            #registrando al usuario
        $stmt = $dbh->prepare("INSERT INTO usuarios (idEstado, idRol, nombre, mail, contrasena, checkMail) VALUES (?, ?, ?, ?, ?, ?)");
        // Bind
        $rol = 1;
        $idEstado = 1;
        $check_mail = 0;

        $stmt->bindParam(3, $username);
        $stmt->bindParam(4, $mail);
        $stmt->bindParam(5, $pass);
        $stmt->bindParam(2, $rol);
        $stmt->bindParam(1, $idEstado);
        $stmt->bindParam(6, $check_mail);

      //print_r($stmt);
        // Execute
        
        if($stmt->execute()){
                           
                include('sendmail.php');
                enviarMail();
                   // if(isset($_POST['confirmarCodigo'])){
            //echo "confirmar FUNCIONAAAAA";
    //}


                 
        }else{
            echo "Error";
        }
    }else{
        echo '
                <script type="text/javascript">

                $(document).ready(function(){
                    let timerInterval
                    Swal.fire({
                    icon: "error",
                    title: "El mail ya está siendo utilizado",
                    didOpen: () => {
                        timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer()
                        if (content) {
                            const b = content.querySelector("b")
                            if (b) {
                            b.textContent = Swal.getTimerLeft()
                            }
                        }
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer")
                    }
                    }) 
                });
               
                </script>
                ';

     }

}else{
    echo "Metodo no autorizado";
}
}

?>