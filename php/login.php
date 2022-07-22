<?php
$login = nl2br(htmlspecialchars(trim( $_POST['user_login'])));
$pass = nl2br(htmlspecialchars(trim($_POST['user_pass'])));

require_once 'auth.class.php';
   $auth = new Auth($DB);
   $log = $auth->auth($login, $pass);
   echo $log;