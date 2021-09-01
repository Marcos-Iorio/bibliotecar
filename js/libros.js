
/* Identifica que libro no tiene stock y le cambia el color */
let matches = document.querySelectorAll('p#etiqueta-info');
let libro = document.querySelectorAll('div#libro-prueba')

for (let i = 0; i < matches.length; i++) {
    /* console.log(matches[2].innerHTML) */
    console.log(libro);
    if(matches[i].innerHTML == "No disponible"){
        libro[i].classList.toggle('libro-prueba-sinStock');
    }else{
        document.getElementById('libro-prueba').classList.toggle('libro-prueba');
    }
    
}