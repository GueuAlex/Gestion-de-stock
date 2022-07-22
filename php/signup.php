<?php
    //var_dump($_POST);
   $user_fname = nl2br(htmlspecialchars(trim($_POST['fname'])));
   $user_lname = nl2br(htmlspecialchars(trim($_POST['lname'])));
   $user_role = nl2br(htmlspecialchars(trim($_POST['rol'])));
   $user_contact = nl2br(htmlspecialchars(trim($_POST['user_contact'])));
   $user_login = nl2br(htmlspecialchars(trim($_POST['user_login'])));
   $user_pass = nl2br(htmlspecialchars(trim($_POST['user_pass'])));

   require_once 'user.class.php';
   $user = new user($DB);
   $insert = $user->insertUser($user_fname, $user_lname, $user_role, $user_contact, $user_login, $user_pass);
   echo $insert;
?>