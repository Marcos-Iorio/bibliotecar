window.onload = function() {
    movimientoLogin();
    requerimientoPass();
};

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

function requerimientoPass(){

    var myInput = document.getElementById("passwordRe");
    document.getElementById("passRequire").style.display = "none";
    myInput.onfocus = function(){
        document.getElementById("passRequire").style.display = "block";
    }
    myInput.onblur = function(){
        document.getElementById("passRequire").style.display = "none";
    }

}

    

function validarMail(){
    const mail = document.querySelector('input#mail');
    const textoValidar = document.querySelector('#resultado');
    const btnRegistrar = document.querySelector('#btn-registro')

    const validarMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    if(validarMail.test(mail.value) === true){
        mail.style.border = "2px solid green";
        if(textoValidar){
            textoValidar.textContent = '';
        }
    }else{
        mail.style.border = "2px solid red";
        if(mail.value.length <= 0){
            textoValidar.textContent = "El mail es inválido";
            textoValidar.style.color = "red";
            textoValidar.style.fontSize = "20px"
  
        }
        textoValidar.textContent = "El mail es inválido";
        textoValidar.style.color = "red";
        textoValidar.style.fontSize = "20px"

    }

}


function mostrarContrasenia(){
    const pass = document.querySelector('#passwordRe');
    const mostrar = document.querySelector('i.fas.fa-eye');
    const esconder = document.querySelector('i.fas.fa-eye-slash');

    if (pass.type === "password") {
        pass.type = "text";
        esconder.classList.add('mostrar');
        mostrar.classList.remove('mostrar');
    } else {
        pass.type = "password";
        esconder.classList.remove('mostrar');
        mostrar.classList.add('mostrar');
    }
}


function mostrarContraseniaLogin(){
    const pass = document.querySelector('#passL');
    const mostrar = document.querySelector('i.fas.fa-eye.login');
    const esconder = document.querySelector('i.fas.fa-eye-slash.login');

    if (pass.type === "password") {
        pass.type = "text";
        esconder.classList.add('mostrar');
        mostrar.classList.remove('mostrar');
    } else {
        pass.type = "password";
        esconder.classList.remove('mostrar');
        mostrar.classList.add('mostrar');
    }
}

const olvidePass = document.querySelector('#olvide_pass');

olvidePass.addEventListener('click', (e) =>{
    e.preventDefault();
    const modal  = document.querySelector('#myModal');
    modal.style.display = "block";
})