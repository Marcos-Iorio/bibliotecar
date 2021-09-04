<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="../js/navbarToggle.js"></script>
    <link rel="stylesheet" href="../css/inicio.css" type="text/css">
</head>
  <body>

  <div class="wrapper" id="sidebar" onmouseover="toggleSidebar()" onmouseout = "toggleSidebar()">
 
 <!-- Sidebar -->
 <nav class="sidebar" >

     <div class="logo">
        <a href="index.php">
         <img id="logo" src="assets/logo sin fondo.png" alt="">
        </a>
     </div>

     <ul class="list-unstyled menu-elements">
        <br><br>
         <?php
         if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        ?>
                 <li id="usuario"><a class="scroll-link " href=""><i class="fas fa-user"></i><span>Mi cuenta</span></a></li>
        <?php
                 } else  {
                     ?>
                      <li id="login"><a class="scroll-link " href='login.php'><i class="fas fa-sign-in-alt"></i><span>Iniciar sesion</span></a></li>
                  <?php
                 }    
                  ?>
         <li class="active">
             <a class="scroll-link" href="index.php"><i class="fas fa-home"></i><span class="menu-item" id="menu-item">Inicio</span></a>
         </li>
         <li>
             <a class="scroll-link" href="libros.php"><i class="fas fa-journal-whills"></i><span class="menu-item" id="menu-item">Portal de libros</span></a>
         </li>
         <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                if ($pid == '1' || $pid == '2' || $pid == '3' ) {
        ?>        
                  <li ><a class="scroll-link" href="sugerencias.php" id="sugerencias"><i class="fas fa-file-signature"></i><span>Sugerencias</span></a></li>
                  <li ><a class="scroll-link" href='contacto.php' id="contacto"><i class="fas fa-envelope"></i><span>Contacto</span></a></li>
                <?php
                }
                ?>
                <?php
                if ($pid == '2' || $pid == '3') {
                ?>
                <li>
                    <a href="#admin-libros" class="scroll-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><i class="fas fa-list"></i><span>Portal de gestion </span></a>
                    <ul class="collapse list-unstyled" id="admin-libros">
                      <li id="abm-libros"><a  class="scroll-link" href="admin-libros.php"><span>Libros</span></a></li>
                      <li id="abm-usuarios"><a  class="scroll-link" href="#"><span>Usuarios</span></a></li>
                    </ul>
      
                </li>
                <?php
                }  
      
              } else { 
                ?>
                <li><a class="scroll-link " href="contacto.php" id="contacto"><i class="fas fa-envelope"></i><span>Contacto</span></a></li>
            <?php  
             }     
            ?>
         <?php 
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            if ($pid == '3' || $pid == '2') {
            ?>
                
                <li id="logout"><a class="scroll-link" href="php/logout.php"><i class="fas fa-sign-out-al"></i><span id="cerrar-sesion">Cerrar sesion</span></a></li>
            <?php
            } elseif ($pid == '1') {
            ?>
                <li id="logout"><a href="php/logout.php"><i class="fas fa-sign-out-alt"></i><span id="cerrar-sesion">Cerrar sesion</span></a></li>
            <?php
            }
            }
         ?>
         </li>
     </ul>
 </nav>
 <!-- End sidebar --> 
    <!-- Dark overlay -->
    <div class="overlay"></div>

 
</div>
<!-- End wrapper -->

  </body>
</html>

