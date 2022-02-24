
<?php
 //starting the session for user profile page
?>

<?php
function accederSistema($mail, $pwd){
    include('db.php');

    session_start();

// if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($mail) && isset($pwd)){
        $GLOBALS['mail'] = strtolower($mail);
        //$_SESSION['loggedin'] = true;
        $pass = $pwd;
        
    // }

    $stmt = $dbh->prepare('SELECT idUsuario, idEstado, idRol, contrasena, nombre, check_mail from usuarios where mail = "' . $mail .'" LIMIT 1');
    // Ejecutamos
    $stmt->execute();


    // Mostramos los resultados
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);



    if($arr['idRol']){
        if(!empty($arr) && password_verify($pass, $arr['contrasena'])){
                if($arr['check_mail'] == '0'){
                
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
                    
                    </script>
                    ';
                }elseif($arr['idEstado'] == 2){
                    echo '
                    <script type="text/javascript">
                    
                    $(document).ready(function(){
                        Swal.fire({
                        icon: "error",
                        title: "Tu cuenta fue dada de baja.",
                        text: "Por cualquier consulta, contactá al soporte.",
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
                }else{
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $arr['nombre'];
                    $_SESSION['mailL'] = $mail;
                    $_SESSION['idUsuario'] = $arr['idUsuario'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + 3600;
                    $_SESSION['rol'] = $arr['idRol'];
                    $_SESSION['mail_confirm'] = false;
                    
                     echo'<script type="text/javascript">
                         window.location.href="index.php";
                         </script>';
                    // header("Location: index.php");
                    // exit;
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


    if (empty($arr)) {
                    echo '
                <script type="text/javascript">
                
                $(document).ready(function(){
                    Swal.fire({
                    icon: "error",
                    title: "El usuario ingresado no existe",
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
    echo "metodo no autorizado";
}


}
?>