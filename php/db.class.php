<?php 
class DB{

    private $host = "localhost";
    private $dbname = "school_tp1";
    private $user = "root";
    private $password = "";
    private $db;

    public function __construct($host=null, $dbname=null, $user=null, $password=null){

        if ($host != null) {
            $this->host = $host;
            $this->dbname = $dbname;
            $this->user = $user;
            $this->password = $password;

        }
        try{
       $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        }catch(PDOException $e){
            die ("une erreure est survenue lors de connexion a la base de données". $e->getMessage());
        }
    }

    public function query($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}