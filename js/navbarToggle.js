var mini = true;

function toggleSidebar() {
  if (mini) {
    console.log("abriendo sidebar");
    document.getElementById("sidebar").style.width = "200px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56, 1)";
    //logo
    document.getElementById("logo").style.width = "200px";
    document.getElementById("logo").style.height = "200px";
    document.getElementById("logo").style.transition = "ease 0.5s";
    document.getElementById("logo").style.zIndex = "1";
    document.getElementById("logo").style.top = "-30px";
    document.getElementById("logo").style.left = "0px";

    if(document.getElementById("cerrar-sesion")){
      document.getElementById("cerrar-sesion").style.display = "inline-block";
    }
    

    this.mini = false;
  } else {
    console.log("Cerrando sidebar");
    document.getElementById("sidebar").style.width = "60px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56, 1)";
    //logo
    document.getElementById("logo").style.width = "100px";
    document.getElementById("logo").style.height = "100px";
    document.getElementById("logo").style.top = "0px";
    document.getElementById("logo").style.left = "-15px";

    if(document.getElementById("cerrar-sesion")){
      document.getElementById("cerrar-sesion").style.display = "none";
    }
    

    this.mini = true;
  }
}

function contacto(){
  window.location.href = "../interfaces/contacto.php"
}

var panel = true;

function desplegarMenu(){
  if(panel){
    document.getElementById('dropdown').style.display = "block";
    document.getElementById("dropdown").style.transition = "ease 0.5s";
    this.panel = false;
  }else{
    document.getElementById('dropdown').style.display = "none";
    document.getElementById("dropdown").style.transition = "ease 0.5s";
    this.panel = true;
  }
}

function showSearch(){
  if(panel){
    document.getElementById('campo-busqueda').style.display="inline-block";
    document.getElementById('buscar').style.display="inline-block";
    this.panel = false;
  }else{
    document.getElementById('campo-busqueda').style.display="none";
    document.getElementById('buscar').style.display="none";
    this.panel = true;
  }
}
