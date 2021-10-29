//Toma la estructura de carpetas y las muestra

var path = "";
var href = document.location.href;
var s = href.split("/");
var sku = getParameterByName('sku');

//Aplica un alias a los hrefs

for (let index = 0; index < s.length; index++) {
    if(s[index] == 'libros.php'){
        s[index] = "Libros";
    }if(s[index] == 'contacto.php'){
        s[index] = "Contacto";
    }if(s[index]== "cuenta.php"){
        s[index] = "Mi cuenta"
    }
    if(s[index]=="single-book.php?sku=" + sku){
        var tituloLibro = document.getElementById("titulo-libro").innerHTML;
        s[index] = tituloLibro;
    }
    
}
//obtiene el id de la URL


//Aplica alias a la ruta

for (var i=5;i<(5);i++) {
   
    path+="<A HREF=\""+href.substring(0,href.indexOf("/"+s[i])+s[i].length+1)+"/\">"+s[i]+"</A> > ";
console.log(path);

}

i = s.length-1;
path+="<A HREF=\""+href.substring(0,href.indexOf(s[i])+s[i].length)+"\">"+s[i]+"</A>";  
let inicio = "<a href=./>Home</a>"
var url = inicio + " > " + path;

//Aplica un alias y agrega una subruta cuando tiene mas de 2 pre rutas
if(path == '<A HREF="http:/">' + tituloLibro + '</A>'){
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