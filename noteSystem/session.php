<?php
    session_start();
    if($_SESSION['loggedin'] == false){
        header('Location: login.php');
    }

?>