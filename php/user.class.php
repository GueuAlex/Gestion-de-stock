<?php
//require_once 'db.class.php';
class user {

    private $user_fname;
    private $user_lname;
    private $user_rol;
    private $user_contact;
    private $user_login;
    private $user_pass;
    private $user_mat;
    private $DB;
    //private $info;


    public function __construct($DB)
    {
        $this->DB = $DB;

        if(!isset($_SESSION)){
            session_start();
            
        }

    }

    public function insertUser($user_fname, $user_lname,  $user_rol, $user_contact, $user_login, $user_pass){
        if(!empty($user_fname) && !empty($user_lname) && !empty($user_contact)){
            $rol_tab = [1, 2, 3];
         if(!empty($user_rol) && in_array($user_rol, $rol_tab)){
             if(!empty($user_login)){
               $req = []; 
               $req = $this->DB->query("SELECT * FROM utilisateur WHERE loginUtil = '{$user_login}'") ;
               $reponse = count($req);
               if($reponse <= 0){
                    if(!empty($user_pass) && strlen($user_pass)>=8){
                        $pass_hasher = password_hash($user_pass, null);
                        $matricul = self::matriculFab($user_fname, $user_lname);
                        
                        $this->user_mat = $matricul;
                        $this->user_fname = $user_fname;
                        $this->user_lname = $user_lname;
                        $this->user_rol = $user_rol;
                        $this->user_contact = $user_contact;
                        $this->user_login = $user_login;
                        $this->user_pass = $pass_hasher;

                        $req2 = $this->DB->query("INSERT INTO utilisateur VALUES('{$this->user_mat}', '{$this->user_fname}', '{$this->user_lname}', '{$this->user_contact}', '{$this->user_login}', '{$this->user_pass}', '{$this->user_rol}')");
                        $info = "success";
                        if($info === "success"){
                            if(!isset($_SESSION)){
                                session_start();
                                $_SESSION['id'] = $matricul;
                                //header('location:../index.php');
                            }else{
                                $_SESSION['id'] = $matricul;
                                //header('location:../index.php');
                            }
                            
                        }else{
                            $info = "Some thing is wrong !";
                        }
                    }else{
                        $info =  'Entrez un mot de passe plus long !'; 
                    }
               }else{
                $info =  'Ce login exite déjà';
               }
             }else{
                $info =  'Entrez un bon Login !';
             }

         }else{
             $info =  'Données corrompues 0';
         }

     }else{
         $info =  'Tous les champs sont obligatoire !';
     }

     return  $info;
    }


    private function matriculFab($nom, $prenom) :string{
        $preMat = strtoupper($nom[0].$prenom[0]);
        $nbr = (string)rand(0, 999);
        if(strlen($nbr) <3){
            $nbr = '0'.$nbr;
        }
        $temps = date('H').date('i').date('s');
        $matricule = $preMat.'-'.$temps.'-'.$nbr;
        return $matricule;
    }


    public function getUser($session_matri){
        $req = $this->DB->query("SELECT * FROM utilisateur WHERE matUtil = '{$session_matri}'") ;
        //var_dump($req);
        return $req;
    }
    
}


require_once 'db.class.php';
$DB = new DB();
//$util = new user($DB);

//$b = $util->insertUser('KLA', 'Gueu', 1, '2250000000', 'vcjc', 'bonjhkhkhkvj');
//$util->getUser($_SESSION['id']);
//echo $b;
//$info = $util->matriculFab('hey', 'ok');