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
        $checkMail = 0;

        $stmt->bindParam(3, $username);
        $stmt->bindParam(4, $mail);
        $stmt->bindParam(5, $pass);
        $stmt->bindParam(2, $rol);
        $stmt->bindParam(1, $idEstado);
        $stmt->bindParam(6, $checkMail);

      //print_r($stmt);
        // Execute
        
        if($stmt->execute()){
                           /* echo '
                <script>swal({
    title:"Registro exitoso",
    text:"",
    type: "success",
    html:\'<br><h5>Te enviamos un codigo a tu mail. Ingresalo debajo para confirmar tu usuario.</h5><br><input style="width: 180px; font-size: 36px; color: black; font-weight: bold; text-align: center;" type="text" required; maxlength = "6";"/><br><br> <div ><input type="submit" style="background-color: #495F91; color:white; margin-right: 5%; width: 150px;" name="confirmarCodigo" value="Confirmar"><input type="submit" style="background-color: gray; color:white;margin-left: 5%; width: 150px;" name="reenviarCodigo" value="Reenviar"></div>\',
   showCancelButton: false,
      showConfirmButton: false,

    cancelButtonColor: "gray",
    confirmButtonColor: "#495F91",
    confirmButtonText: "Confirmar <i name="confirmarCodigo"></i>",
    cancelButtonText: "Reenviar <i name="reenviarCodigo></i>",
    width: 500,
    padding: "3em"

}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      "Deleted!",
      "Your file has been deleted.",
      "success"
    )
  }
});</script>
                ';*/
                
                
/*<script type="text/javascript">

                $(document).ready(function(){
                    let timerInterval
                    Swal.fire({
                    icon: "Warning",
                    title: "Te enviamos un codigo a tu casilla de correo electrónico para confirmar tu mail!",
                    html: "Serás redireccionado en <b></b> milisegundos.",
                    timer: 7000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
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
                    /* Read more about handling dismissals below 
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer")
                    }
                    }) 
                });
               
                </script>                
                               echo '
                <script type="text/javascript">

                $(document).ready(function(){
                    let timerInterval
                    Swal.fire({
                    icon: "Warning",
                    title: "Te enviamos un codigo a tu casilla de correo electrónico para confirmar tu mail!",
                    html: "Serás redireccionado en <b></b> milisegundos.",
                    timer: 7000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
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
                    /* Read more about handling dismissals below 
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer")
                    }
                    }) 
                });
               
                </script>
                ';*/
  





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