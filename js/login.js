function movimientoLogin(){
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
}
//Movimiento del libro del fondo
function mouseMove(){
    var libro = document.getElementById("libroIcon");
    var moving = false;

    libro.addEventListener("mousedown", initialClick, false);

    function move(e){
        var newX = e.clientX - 10;
        var newY = e.clientY - 10;

        image.style.left = newX + "px";
        image.style.top = newY + "px";
    }

    function initialClick(e) {
        if(moving){
            document.removeEventListener("mousemove", move);
            moving = !moving;
            return;
        }
        
        moving = !moving;
        image = this;

        document.addEventListener("mousemove", move, false);
    }
}
$(document).ready(function(){
    $('#libroIcon').popover('show');
});
//popOver
function popover(){
    var libro = document.getElementById("libroIcon");
    libro.addEventListener('click',() =>{
        $('#libroIcon').popover('hide');
    });
}

function requerimientoPass(){
    $('#passwordRe').focusin(function(){
        $('#passRequire').removeClass('hidden');
        $('#passRequire').fadeIn(2000);
        
        
    })
    $('#passwordRe').focusout(function(){
        $('#passRequire').addClass('hidden');
        $('#passRequire').fadeOut(2000);
    })

}

console.log("adsafa")
