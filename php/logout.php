<?php
if(!isset($_SESSION)){
    session_start();
    //var_dump($_SESSION['id']);
    session_destroy();
    session_unset();
    header('location:../vue/login.php');
}else {
    session_destroy();
    session_unset();
    header('location:../vue/login.php');
}