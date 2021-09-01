<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
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

    $stmt = $dbh->prepare('SELECT idRol, contrasena, nombre, checkMail from usuarios where mail = "' . $mail .'" LIMIT 1');
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);

    if($arr['idRol']){
        if(!empty($arr) && password_verify($pass, $arr['contrasena'])){
        
            if($arr['checkMail'] == '0'){
                
                echo '
                <script type="text/javascript">
                
                $(document).ready(function(){
                    Swal.fire({
                    icon: "error",
                    title: "Falta confirmar mail!",
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
                
                setTimeout(function(){
                    window.location.href = "../interfaces/login.php";
                 }, 3000);
                </script>
                ';
        
            }else{
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $arr['nombre'];
                $_SESSION['mailL'] = $_POST['mailL'];
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + 3600;
                $_SESSION['rol'] = $arr['idRol'];
                $_SESSION['mail_confirm'] = false;
                
                echo'<script type="text/javascript">
                    setTimeout(window.location.href="../index.php", 3000);
                    </script>';
            }
        }else{
            echo '
                <script type="text/javascript">
                
                $(document).ready(function(){
                    Swal.fire({
                    icon: "error",
                    title: "Credenciales erroneas",
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
                
                setTimeout(function(){
                    window.location.href = "../interfaces/login.php";
                 }, 3000);
                </script>
                ';

           /*  echo'<script type="text/javascript">
                window.location.href="../interfaces/login.php";
                </script>'; 
                
                setTimeout(function(){
                    window.location.href = "../interfaces/login.php";
                 }, 3000);*/
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