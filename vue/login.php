<?php
    if(!isset($_SESSION)){
        session_start(); 

    }
    
    if(isset($_SESSION['id']) && !empty(trim($_SESSION['id']))){
        header('location:../index.php');
    }else{
        require_once '../php/user.class.php';
        $current_user = new user($DB);
        
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login |</title>
</head>
<body>
    <main>
        <form action="" method="post" class="form">
            <h3>Login |</h3>
            <div class="err_msg2">Tous les champs sont obligatoire !</div>
            <div class="form_content">
                <label for="user_name">Nom d'utilisateur</label><br>
                <div class="name_field">
                    <div class="svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                          </svg>
                    </div>
                    <input type="text" name="user_login" id="user_name">
                </div>
                <br>
                <label for="pass">Mot de passe</label><br>
                <div class="pass_field">
                    <div class="svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                            <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/>
                          </svg>
                    </div>
                    <input type="password" name="user_pass" id="pass">
                </div><br>
                <div class="btn">
                    <input class="button" type="submit" value="connexion">
                </div>
                <div class="question">
                    <p>Pas encore inscrit ? <a href="signup.php"> Inscription</a></p>
                </div>
            </div>
        </form>
    </main>

    <script src="../js/login.js"></script>
</body>
</html>