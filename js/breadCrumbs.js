//Toma la estructura de carpetas y las muestra
var sku = getParameterByName('sku');

var page = window.location.pathname.split('/').pop();

//Aplica un alias a los hrefs


if(page == 'libros.php'){
    page = "Libros";
}if(page == 'contacto.php'){
    page = "Contacto";
}if(page == "cuenta.php"){
    page = "Mi cuenta"
}
if(page =="single-book.php"){
    var tituloLibro = document.getElementById("titulo-libro").innerHTML;
    page = tituloLibro;
}
    
//Aplica alias a la ruta
let inicio = "<a>Inicio</a>"
var url = inicio + " > " + page;

//Aplica un alias y agrega una subruta cuando tiene mas de 2 pre rutas
console.log(page)
if(page == tituloLibro){
    url = inicio + " > " + '<a>Libros</a>' + ' > ' + page
}else{
    url = inicio + " > " + page;
}

//Muestra el breadcrumb en el front
document.getElementById('breadcrumbs').innerHTML = url; 

//Busca y encuentra en la URL la variable pasada, imita una funcion $_GET[]
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}