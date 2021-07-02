<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <section id="page">
        <nav id="sidebar"  onmouseover="toggleSidebar()" onmouseout="toggleSidebar()">
            <ul id="hovered">
                <li><img class="logo" src="../assets/Logo sin fondo.PNG" alt=""><a href=""></a></li>
                <li id="home"><a href=""><span>Home</span></a></li>
                <li id="portal-libro"><a href=""><span>Portal de libros</span></a></li>
                <li id="portal-gestion">
                    <ul id="colab-admin" class="dropdown">
                        <li id="gestion-libros">Gestion de libros
                            <ul>
                                <li id="abm-libros"><a href="#">Alta y baja de libros</a></li>
                                <li id="devoluciones"><a href="#">Devoluciones</a></li>
                                <li id="reservas"><a href="#">Reservas</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul id="admin" class="dropdown">
                        <li id="gestion-usuarios">Gestion de usuarios
                            <ul>
                                <li id="abm-usuarios"><a href="#">Alta y baja de usuarios</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>                   
        </nav>
        <main id="main">
            <h1>Sidebar con main area de libros</h1>
            <p>
                Hover en el sidebar para desplegar
            </p>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>
</html>
<script src="../js/navbarToggle.js"></script>
<script src="../js/validacionMenu.js"></script>