        <!DOCTYPE html>
        <html>
         <nav id="sidebar"  onmouseover="toggleSidebar()" onmouseout="toggleSidebar()">
            <ul id="hovered">
                <li><img  id="logo" class="logo" src="assets/Logo sin fondo.png" alt=""><a href=""></a></li>

                                   
                 <?php
               if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                 echo "<li id=\"usuario\"><a href=\"\"><span>Mi cuenta</span></a></li><li id=\"home\"><a href=\"#\"><span>Inicio</span></a></li>";
                 //echo "<a style='padding-left:10px' href='php/logout.php'><FONT style='color: white' SIZE=2>Cerrar Sesión</FONT></a> </p>";
                 } else  {
                      echo "<li id=\"login\"><a href='interfaces/login.php'><span>Iniciar sesion</span></a></li><li id=\"home\"><a href=\"/interfaces/home.php\"><span>Inicio</span></a></li>";
                  
                 }     
              ?>
                <li id="portal-libro"><a href="interfaces/libros.php"><span>Portal de libros</span></a></li>
    <script>
      function myFunction() {
        document.getElementById("demo").innerHTML = "Hello Dear Visitor!</br> ";
      }
    </script>

    <?php 
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
          if ($pid == '1' || $pid == '2' || $pid == '3' ) {
            //echo "<li><a href=\"\"  id=\"cuenta\"><span>Cuenta</span></a></li>
            echo "
            <li ><a href=\"\" id=\"sugerencias\"><span>Sugerencias</span></a></li>
            <li ><a href='interfaces/contacto.php' id=\"contacto\"><span>Contacto</span></a></li>";
          }
          
          if ($pid == '2' || $pid == '3') {

          echo "<li>
                <a id=\"portal-gestion\" onclick=\"desplegarMenu()\">Portal de gestion </a>
              <ul id=\"dropdown\">
                <li id=\"abm-libros\"><a href=\"interfaces/admin-libros.php\">Libros</a></li>
                <li id=\"abm-usuarios\"><a href=\"#\">Usuarios</a></li>
              </ul>

          </li>";
          }  

        } else { 
          echo"<li ><a href=interfaces/contacto.php id=\"contacto\"><span>Contacto</span></a></li>";
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
            <li id=\"logout\"><a href=\"php/logout.php\"><span id=\"cerrar-sesion\">Cerrar sesion</span></a></li>";
          } elseif ($pid == '1') {
            echo "
            <br>
            <br>
            <br>
            <br>
            <li id=\"logout\"><a href=\"php/logout.php\"><span id=\"cerrar-sesion\">Cerrar sesion</span></a></li>";
          }
        }
      ?>
    </ul>    
  </nav>
</html>

