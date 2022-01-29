
/* Identifica que libro no tiene stock y le cambia el color */
let matches = document.querySelectorAll('p#etiqueta-info');
let libro = document.querySelectorAll('div#libro-prueba');

let cantidadLibros = matches.length

for (let i = 0; i < cantidadLibros; i++) {
    if(matches[i].innerHTML == 'No disponible '){
        libro[i].classList.toggle('libro-prueba-sinStock');
    }else{
        document.getElementById('libro-prueba').classList.toggle('libro-prueba');
    }
    
}

function abrirFiltros(){
    let menuFiltro = document.getElementById('menu-filtro');
    if(menuFiltro.style.width === "0px"){
        menuFiltro.style.width = "275px"
        menuFiltro.style.paddingLeft = "20px"
        menuFiltro.style.overflowY = "scroll";
    }else{
        menuFiltro.style.width = "0px"
        menuFiltro.style.paddingLeft = "0px"
    }
}
