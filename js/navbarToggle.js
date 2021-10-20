var mini = true;

var menuSpan = document.getElementsByClassName('menu-item');
var itemGestion = document.getElementsByClassName('item-gestion');


function toggleSidebar() {
  if (mini) {

    document.getElementById("sidebar").style.width = "200px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56, 1)";
    
    //logo
    document.getElementById("logo").style.width = "200px";
    document.getElementById("logo").style.height = "200px";
    document.getElementById("logo").style.transition = "ease 0.3s";
    document.getElementById("logo").style.zIndex = "100";
    document.getElementById("logo").style.top = "-20px";
    document.getElementById("logo").style.left = "0px";
    
    for (var i = 0; i < menuSpan.length; i++) {
      menuSpan[i].style.display = "inline-block";
      menuSpan[i].style.position = "fixed";
    }

    for (var i = 0; i < itemGestion.length; i++) {
      itemGestion[i].style.display = "inline-block";
    }
    
    this.mini = false;

  } else {
    document.getElementById("sidebar").style.width = "60px";
    document.getElementById("sidebar").style.backgroundColor = "rgb(56, 56, 56, 1)";
    //logo
    document.getElementById("logo").style.width = "100px";
    document.getElementById("logo").style.height = "100px";
    document.getElementById("logo").style.top = "0px";
    document.getElementById("logo").style.left = "-20px";

      for (var i = 0; i < menuSpan.length; i++) {
        menuSpan[i].style.display = "none";
        menuSpan[i].style.position = "fixed";
      }

      for (var i = 0; i < itemGestion.length; i++) {
        itemGestion[i].style.display = "none";
      }

    this.mini = true;
  }
}

function contacto(){
  window.location.href = "interfaces/contacto.php"
}

var panel = true;

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

function startTime() {
  var today = new Date();
  var hr = today.getHours();
  var min = today.getMinutes();
  var sec = today.getSeconds();
  //Add a zero in front of numbers<10
  min = checkTime(min);
  sec = checkTime(sec);
  document.getElementById("clock").innerHTML = hr + " : " + min + " : " + sec;
  var time = setTimeout(function(){ startTime() }, 500);
}

function checkTime(i) {
  if (i < 10) {
      i = "0" + i;
  }
  return i;
}


function moveArrow(){
  let flecha = document.getElementById('flecha');
  let item = document.getElementById('dropdown-toggle');

  if(item.className == "scroll-link"){
    flecha.style.transform = "rotate(90deg)";
    item.classList.add("collapsed")
  }else{
    flecha.style.transform = "rotate(0deg)";
    item.classList.remove("collapsed")
  }
}

function moveArrowReservas(){
  let flecha = document.getElementById('flecha-reserva');
  let item = document.getElementById('dropdown-toggle');

  if(item.className == "scroll-link"){
    flecha.style.transform = "rotate(90deg)";
    item.classList.add("collapsed")
  }else{
    flecha.style.transform = "rotate(0deg)";
    item.classList.remove("collapsed")
  }
}