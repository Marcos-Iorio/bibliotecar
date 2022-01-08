<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/olvidar-contrasenia.css">
    <title>Document</title>
</head>
<body>
<div class="pass__require hidden" id ="passRequire">
        <h3>La contraseña debe contener:</h3>
        <p id="letter" class="invalid">Una <b>letra</b> Minúscula</p>
        <p id="capital" class="invalid">Una <b>letra</b> Mayúscula</p>
        <p id="number" class="invalid">Un <b>numero</b></p>
        <p id="length" class="invalid">Mínimo <b>8 carácteres</b></p>
    </div>
    <div class="contenedor">
        <form action="" method="POST" id="form-contrasenia">
            <h2 class="titulo-recuperacion">Recuperacion de contraseña:</h2>
            <label for="password" onfocus="requerimientosPass()">Contraseña:</label>
            <input type="password" name="" id="password">
            <label for="repetir-password">Repetir contraseña:</label>
            <input type="password" name="" id="repetir-password">

            <button id="btn-actualizar" value="Actualizar">Actualizar
        </form>
        <button id="mostrar-passwords">Mostrar contraseñas</button>
        <p id="resultado"></p>
    </div>
    
</body>
</html>
<script>
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

var myInput = document.getElementById("password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    myInput.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {
          letter.classList.remove("invalid");
          letter.classList.add("valid");
        } else {
          letter.classList.remove("valid");
          letter.classList.add("invalid");
      }
      
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
        } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
        }
      
        // Validate numbers
        var numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {
          number.classList.remove("invalid");
          number.classList.add("valid");
        } else {
          number.classList.remove("valid");
          number.classList.add("invalid");
        }
      
        // Validate length
        if(myInput.value.length >= 8) {
          length.classList.remove("invalid");
          length.classList.add("valid");
        } else {
          length.classList.remove("valid");
          length.classList.add("invalid");
        }

        if(myInput.value.match(numbers) && myInput.value.length >= 8 && myInput.value.match(upperCaseLetters) && (myInput.value.match(lowerCaseLetters))){
            document.querySelector('#btn-actualizar').disabled = false;
        }else{
            document.querySelector('#btn-actualizar').disabled = true
        }
      }

</script>
<script>

    const btnPass = document.querySelector('#mostrar-passwords');
    const pass = document.querySelector('#password');
    const repetirPass = document.querySelector('#repetir-password');

    btnPass.addEventListener('click', () =>{
    if (pass.type === "password") {
        repetirPass.type = "text";
        pass.type = "text";
    } else {
        repetirPass.type = "password";
        pass.type = "password";
    }
    });

    repetirPass.addEventListener('blur', () =>{
        if(pass.value === repetirPass.value){
            resultado.textContent = "";
            document.querySelector('#btn-actualizar').disabled = false;
        }else{
            const resultado = document.querySelector('#resultado');
            resultado.textContent = "Las contraseñas no coinciden";
            document.querySelector('#btn-actualizar').disabled = true;
        }
    });
    
</script>