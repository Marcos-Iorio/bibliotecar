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
    <script src="js/mensajes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <title>Document</title>
</head>
<body>
    <section id="page">
        <nav id="sidebar"  onmouseover="toggleSidebar()" onmouseout="toggleSidebar()">
            <ul id="hovered">
                <li><img class="logo" src="assets/Logo sin fondo.png" alt=""><a href=""></a></li>
                <li ><a href="../index.php" id="home"><span>Inicio</span></a></li>
                <li ><a href="interfaces\libros.php" id="portal-libro"><span>Portal de libros</span></a></li>
                <?php 
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    if ($pid == '1' || $pid == '2' || $pid == '3' ) {
                      echo "<li><a href=\"\" id=\"cuenta\"><span>Cuenta</span></a></li>
                      <li><a href=\"\" id=\"sugerencias\"><span>Sugerencias</span></a></li>
                      <li><a href='interfaces/contacto.php' id=\"contacto\"><span>Contacto</span></a></li>";
                    }
                    
                    if ($pid == '2' || $pid == '3') {

                      echo "
                      <li><a href=\"\"  id=\"portal-gestion\"><span>Portal de gestion</span></a></li>
                      <br>
                      <br>
                      <br>
                      <br>";
                    }  

                  } else { 
                    echo"<li><a href='interfaces/contacto.php'  id=\"contacto\"><span>Contacto</span></a></li>";
                  }     
                ?>
                <!--<li id="cuenta"><a href=""><span>Cuenta</span></a></li>
                <li id="sugerencias"><a href=""><span>Sugerencias</span></a></li>
                <li id="contacto"><a href=""><span>Contacto</span></a></li>
                <li id="portal-gestion"><a href=""><span>Portal de gestion</span></a></li> -->

                <?php 
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    if ($pid == '3' || $pid == '2') {
                      echo "
                      <li id=\"logout\"><a href=\"php/logout.php\"><span>Cerrar sesion</span></a></li>";
                    } elseif ($pid == '1') {
                      echo "
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <li id=\"logout\"><a href=\"php/logout.php\"><span>Cerrar sesion</span></a></li>";
                    }
                  }
                 ?>

            </ul>    

        </nav>
        <main id="main">
            <h1 class="main">BibliotecAr</h1>
            <p class = "main">
                <?php
               if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                 echo "Bienvenido  $user!";
                 
                 //echo "<a style='padding-left:10px' href='php/logout.php'><FONT style='color: white' SIZE=2>Cerrar Sesión</FONT></a> </p>";
                 }else  {
                   echo "<a href='interfaces/login.php'><FONT style='color: white' SIZE=2>Iniciar Sesión</FONT></a> </p>";
                 }     
              ?>
            </p>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>
  <script src="./js/navbarToggle.js"></script>
</html>

