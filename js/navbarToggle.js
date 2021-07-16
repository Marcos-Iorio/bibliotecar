var mini = true;

function toggleSidebar() {
  if (mini) {
    console.log("abriendo sidebar");
    document.getElementById("sidebar").style.width = "200px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56, 0.85)";
    

    this.mini = false;
  } else {
    console.log("Cerrando sidebar");
    document.getElementById("sidebar").style.width = "60px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56, 1)";

    this.mini = true;
  }
}

function contacto(){
  window.location.href = "../interfaces/contacto.php"
}
