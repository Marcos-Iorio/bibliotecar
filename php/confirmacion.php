
<!DOCTYPE html>
<?php
      session_start();

      /*  is_logged(); */
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
       $user=$_SESSION['username'];
       $pid=$_SESSION['rol'];
   
       $tiempo = time();
   
       if ($tiempo >= $_SESSION['expire']) {
         session_destroy();
          echo'<script type="text/javascript">
                 alert("Su sesion ha expirado, por favor vuelva iniciar sesion.");
                 </script>';
         header("Refresh:0");
       
       }
       
     }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <form action="confirmacion.php" method="POST">
            <h1>Para confirmar el mail haga click en el boton "confirmar"</h1>
            <button onclick="confirmar()">Confirmar</button>
        </form>
    </div>
</body>
</html>
<script>
    
    function confirmar(){
        <?php
            include('db.php');
            include('login-back.php');
            $stmt = $dbh->prepare('UPDATE usuarios SET checkMail = 1 where mail = "' . $_SESSION['mailL'] .'"');
            // Ejecutamos
            $stmt->execute();
        ?>

        let timerInterval = 0;
        Swal.fire({
        title: 'Mail confirmado!',
        html: 'Esta pestaña se cerrará en <b></b> milisegundos.',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
            const content = Swal.getHtmlContainer()
            if (content) {
                const b = content.querySelector('b')
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
            console.log('I was closed by the timer')
            }
        })
    }
            
</script>