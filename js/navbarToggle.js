var mini = true;

function toggleSidebar() {
  if (mini) {
    console.log("abriendo sidebar");
    document.getElementById("sidebar").style.width = "200px";
    document.getElementById("main").style.paddingLeft = "240px";
    this.mini = false;
  } else {
    console.log("Cerrando sidebar");
    document.getElementById("sidebar").style.width = "60px";
    document.getElementById("main").style.paddingLeft = "85px";
    this.mini = true;
  }
}

function contacto(){
  window.location.href = "/html/contacto.html"
}
