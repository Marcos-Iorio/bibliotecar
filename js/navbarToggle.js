var mini = true;

function toggleSidebar() {
  if (mini) {
    console.log("abriendo sidebar");
    document.getElementById("sidebar").style.width = "200px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56)";
    //logo
    document.getElementById("logo").style.width = "200px";
    document.getElementById("logo").style.height = "200px";
    document.getElementById("logo").style.transition = "ease in 0.5s";
    document.getElementById("logo").style.zIndex = "1";
    document.getElementById("logo").style.top = "-30px";
    document.getElementById("logo").style.left = "0px";
    document.getElementById("logo").style.transition = "ease in 0.5s";
    

    this.mini = false;
  } else {
    console.log("Cerrando sidebar");
    document.getElementById("sidebar").style.width = "60px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56)";
    //logo
    document.getElementById("logo").style.width = "100px";
    document.getElementById("logo").style.height = "100px";
    document.getElementById("logo").style.top = "0px";
    document.getElementById("logo").style.left = "-15px";
    document.getElementById("logo").style.transition = "ease in 0.5s";
   
    this.mini = true;
  }
}

function contacto(){
  window.location.href = "../interfaces/contacto.php"
}
