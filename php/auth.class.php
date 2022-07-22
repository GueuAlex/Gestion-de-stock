<?php

class Auth{

    private $DB;

    public function __construct($DB)
    {
        $this->DB = $DB;

        if(!isset($_SESSION)){
            session_start();
            
        }
    }

    public function auth($user_login, $user_pass){
        if(!empty($user_login) && !empty($user_pass)){
            $req = []; 
            $req = $this->DB->query("SELECT * FROM utilisateur WHERE loginUtil = '{$user_login}'");
            if(count($req) > 0){
                foreach ($req as $value) {
                    $pass_hash = $value->passwordUtil;
                }
                if(password_verify($user_pass, $pass_hash) && ($user_login === $value->loginUtil)){
                    if(!isset($_SESSION)){
                        session_start();
                        $_SESSION['id'] = $value->matUtil;
                        //$session_id = $_SESSION['id'];
                        //header('location:../index.php');
                        $info = 'ok';
                    }else{
                        $_SESSION['id'] = $value->matUtil;
                        //$session_id = $_SESSION['id'];
                        //header('location:../index.php');
                        $info = 'ok';
                    }
                }else{
                     $info = "Login ou mot de passe incorrect !"; 
                }
            }else{
                 $info = "Login ou mot de passe incorrect !"; 
            }
        }else{
             $info = "Tous les champs sont obligatoire !";
        }

       return $info;
    }
}


require_once 'db.class.php';
$DB = new DB();
