<?php 
    function is_logged(){
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
    }

?>