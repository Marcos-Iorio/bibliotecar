//Toma la estructura de carpetas y las muestra

var path = "";
var href = document.location.href;
var s = href.split("/");

//Aplica un alias a los hrefs
if(s[5] == 'libros.php'){
    s[5] = "Libros";
}if(s[5] == 'contacto.php'){
    s[5] = "Contacto";
}if(s[5]== "cuenta.php"){
    s[5] = "Mi cuenta"
}

//obtiene el id de la URL
var sku = getParameterByName('sku');

//Aplica alias a la ruta
if(s[5]=="single-book.php?sku=" + sku){
    var tituloLibro = document.getElementById("titulo-libro").innerHTML;
    s[5] = tituloLibro;
}

for (var i=2;i<(2);i++) {
   
    path+="<A HREF=\""+href.substring(0,href.indexOf("/"+s[i])+s[i].length+1)+"/\">"+s[i]+"</A> > ";

}

i = s.length-1;
path+="<A HREF=\""+href.substring(0,href.indexOf(s[i])+s[i].length)+"\">"+s[i]+"</A>";  
let inicio = "<a href=./>Home</a>"
var url = inicio + " > " + path;

//Aplica un alias y agrega una subruta cuando tiene mas de 2 pre rutas
if(path == '<A HREF="http:">' + tituloLibro + '</A>'){
    console.log("entró")
    url = inicio + " > " + '<a href="libros.php">Libros</a>' + ' > ' + path
}else{
    url = inicio + " > " + path;
}

document.getElementById('breadcrumbs').innerHTML = url; 


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}