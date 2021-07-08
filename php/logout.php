<?php

session_start();
unset ($SESSION['username']);
unset ($SESSION['mailL']);
unset ($SESSION['loggedin']);
unset ($SESSION['username']);

session_destroy();

header("Location: ../html/login.php")

?>