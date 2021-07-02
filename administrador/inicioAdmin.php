<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <section id="page">
        <nav id="sidebar"  onmouseover="toggleSidebar()" onmouseout="toggleSidebar()">
            <ul id="hovered">
                <li><img class="logo" src="/assets/Logo sin fondo.png" alt=""><a href=""></a></li>
                <li id="home"><a href=""><span>Home</span></a></li>
                <li id="portal-libro"><a href=""><span>Portal de libros</span></a></li>
                <li id="portal-gestion">Portal de Gestión
                     <ul class="dropdown">
                        <li id="admin-users"><a href="#">Administrar Usuarios</a></li>
                       <!--  <li><a href="#">Sub-2</a></li>
                        <li><a href="#">Sub-3</a></li> -->
                    </ul>
                </li>
            </ul>                   
        </nav>
        <main id="main">
            <h1>Página del administrador</h1>
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
<script src="/js/navbarToggle.js"></script>