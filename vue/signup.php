<?php
if(!isset($_SESSION)){
    session_start(); 

}

if(isset($_SESSION['id']) && !empty(trim($_SESSION['id']))){
    header('location:../index.php');
}else{
    require_once '../php/db.class.php';
    $DB = new DB();
    $req = $DB->query('SELECT * FROM role');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Inscription |</title>
</head>
<body>
    <main>
        <form action="#" method="post" class="form">
            <h3>Inscription |</h3>
            <div class="err_msg">Tous les champs sont obligatoire !</div>
            <div class="name_container">
                <div class="marge">
                    <label for="nom">Nom</label><br>
                    <div class="nom">
                      <input type="text" id="nom" name="fname">
                    </div>
                </div>
                <div>
                    <label for="prenom">Prénoms</label><br>
                    <div class="prenom">
                      <input type="text" id="prenom" name="lname">
                    </div>
                </div>
            </div>
            
            <br>

            <div class="contact_rol">
               <div class="marge">
                    <label for="rol">Role</label><br>
                    <div class="rol">
                        <select id="rol" name="rol">
                            <?php foreach ($req as $value):?>
                            <option value="<?=$value->idRole?>"><?=$value->libRole?></option>
                            <?php endforeach?>
                        </select>
                    </div>
               </div>
                <div class="marge1">
                    <label for="contact">Contact</label><br>
                    <div class="contact">
                        <input type="text" id="contact" name="user_contact">
                    </div>
                </div>
            </div>
            
            <br>

            <div class="pass_log">
                <div class="marge">
                    <label for="login">Login</label><br>
                    <div class="login">
                        <input type="text" id="login" name="user_login">
                    </div>
                </div>
                <div>
                    <label for="password">Mot de passe</label><br>
                    <div class="password">
                        <input type="password" id="password" name="user_pass">
                    </div>
                </div>
            </div>
            
            <br>
            
            <div class="btn">
                <input class="button" type="submit" value="S'inscrire" name="submit">
            </div>
            <div class="question">
                <p>Déjà inscrit ? <a href="login.php"> Se connecter</a></p>
            </div>

        </form>
    </main>

    <script src="../js/signup.js"></script>
</body>
</html>