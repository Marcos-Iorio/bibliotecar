function abrirSeccionLibro(){
    document.getElementById('seccion-autor').style.display = "none";
    document.getElementById('seccion-categorias').style.display = "none";
    document.getElementById('seccion-editorial').style.display = "none";
    
   let seccionLibros = document.getElementById('seccion-libros');

   if(seccionLibros.style.display == ''){
    seccionLibros.style.display = "block";
   }
   else if(seccionLibros.style.display == 'none'){
       seccionLibros.style.display = "block";  
   }else{
       seccionLibros.style.display = "none";
   }
}

function abrirSeccionAutor(){
    document.getElementById('seccion-libros').style.display = "none";
    document.getElementById('seccion-categorias').style.display = "none";
    document.getElementById('seccion-editorial').style.display = "none";

    console.log("entro a la funcion")

   let seccionAutor = document.getElementById('seccion-autor');

   if(seccionAutor.style.display == ''){
    seccionAutor.style.display = "block";
   }
   else if(seccionAutor.style.display == 'none'){
       seccionAutor.style.display = "block";  
   }else{
       seccionAutor.style.display = "none";
   }
}

function abrirSeccionCategoria(){
    document.getElementById('seccion-libros').style.display = "none";
    document.getElementById('seccion-autor').style.display = "none";
    document.getElementById('seccion-editorial').style.display = "none";

    console.log("entro a la funcion")

   let seccionCategoria = document.getElementById('seccion-categorias');

   if(seccionCategoria.style.display == ''){
    seccionCategoria.style.display = "block";
   }
   else if(seccionCategoria.style.display == 'none'){
       seccionCategoria.style.display = "block";  
   }else{
       seccionCategoria.style.display = "none";
   }
}

function abrirSeccionEditorial(){
    document.getElementById('seccion-libros').style.display = "none";
    document.getElementById('seccion-autor').style.display = "none";
    document.getElementById('seccion-categorias').style.display = "none";

    console.log("entro a la funcion")

   let seccionEditorial = document.getElementById('seccion-editorial');

   if(seccionEditorial.style.display == ''){
    seccionEditorial.style.display = "block";
   }
   else if(seccionEditorial.style.display == 'none'){
       seccionEditorial.style.display = "block";  
   }else{
       seccionEditorial.style.display = "none";
   }
}

function modalLibros(){
    let tituloLibro = document.getElementById('titulo-libro')

    /* Resetea el modal */
    document.getElementById('form-libros').reset();
    document.getElementById('select-autor').value;
    document.getElementById('select-categoria').nodeValue = 0
    document.getElementById('select-editorial').nodeValue = 0

    /* Obtiene el modal */
    let modalLibro = document.getElementById('modal-libros')

    if(modalLibro.style.display == ''){
        modalLibro.style.display = "block"
        document.getElementById('editar-libro').style.display = "none";
        document.getElementById('crear-libro').style.display = "block";
        tituloLibro.innerHTML = "Agregar libro";
    }else if(modalLibro.style.display = "none"){
        modalLibro.style.display = "block";
        document.getElementById('editar-libro').style.display = "none";
        document.getElementById('crear-libro').style.display = "block";
        tituloLibro.innerHTML = "Agregar libro";
    }else{
        tituloLibro.innerHTML = "Modificar Libro"

    }

}

function modalAutores(){

    /* Resetea el modal */
    document.getElementById('formAutores').reset();

    /* Obtiene el modal */
    let modalAutor = document.getElementById('modal-autor')

    if(modalAutor.style.display == ''){
        modalAutor.style.display = "block"
        document.getElementById('editar-autor').style.display = "none";
        document.getElementById('crear-autor').style.display = "block";

    }else if(modalAutor.style.display = "none"){
        modalAutor.style.display = "block";
        document.getElementById('editar-autor').style.display = "none";
        document.getElementById('crear-autor').style.display = "block";

    }else{

    }
    var span = document.getElementById("close-autor");

    span.onclick = function() {
        modalAutor.style.display = "none";
    }
}

function modalCategorias(){

    /* Resetea el modal */
    document.getElementById('formCategorias').reset();

    /* Obtiene el modal */
    let modalCategoria = document.getElementById('modal-categoria')

    if(modalCategoria.style.display == ''){
        modalCategoria.style.display = "block"
        document.getElementById('editar-categoria').style.display = "none";
        document.getElementById('crear-categoria').style.display = "block";

    }else if(modalCategoria.style.display = "none"){
        modalCategoria.style.display = "block";
        document.getElementById('editar-categoria').style.display = "none";
        document.getElementById('crear-categoria').style.display = "block";

    }else{

    }
    var span = document.getElementById("close-categoria");

    span.onclick = function() {
        modalCategoria.style.display = "none";
    }

}

function modalEditoriales(){

    /* Resetea el modal */
    document.getElementById('formEditorial').reset();

    /* Obtiene el modal */
    let modalEditorial = document.getElementById('modal-editorial')

    if(modalEditorial.style.display == ''){
        modalEditorial.style.display = "block"
        document.getElementById('editar-editorial').style.display = "none";
        document.getElementById('crear-editorial').style.display = "block";

    }else if(modalEditorial.style.display = "none"){
        modalEditorial.style.display = "block";
        document.getElementById('editar-editorial').style.display = "none";
        document.getElementById('crear-editorial').style.display = "block";

    }else{

    }
    var span = document.getElementById("close-editorial");

    span.onclick = function() {
        modalEditorial.style.display = "none";
    }

}

function modalUsuario(){
    /* Resetea el modal */
    document.getElementById('formUsuarios').reset();

    /* Obtiene el modal */
    let modalUsuario = document.getElementById('modal-usuario')

    if(modalUsuario.style.display == ''){
        modalUsuario.style.display = "block"
        document.getElementById('editar-usuario').style.display = "none";
        document.getElementById('crear-usuario').style.display = "block";

    }else if(modalUsuario.style.display = "none"){
        modalUsuario.style.display = "block";
        document.getElementById('editar-usuario').style.display = "none";
        document.getElementById('crear-usuario').style.display = "block";

    }else{

    }
    var span = document.getElementById("close");

    span.onclick = function() {
        modalUsuario.style.display = "none";
    }

}