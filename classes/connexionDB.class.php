<?php


class ConnexionDB {

    private static $instance = null;
    private $bdd;
    public $host   ; //= 'localhost';
    public $port   ; //= 3306;
    public $dbname ; //= 'grh';
    public $user   ; //= 'vince';
    public $mdp    ; //= 'bitonio';

    private function __construct($host, $port, $dbname, $user, $mdp)
    {
        try {
          $this->bdd = new PDO("mysql:host=".$host.":".$port.";dbname=".$dbname.";charset=UTF8",$user,$mdp, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } 
        catch (PDOException $e) {
            echo "Echec connexion : ", $e->getMessage();
            return false;
            exit();
        }
    }

    public static function getInstance($host, $port, $dbname, $user, $mdp)
    {
      if(!self::$instance)
      {
        self::$instance = new ConnexionDB($host, $port, $dbname, $user, $mdp);
      }
  
      return self::$instance;
    }

    public function getConnection()
    {
      return $this->bdd;   
    }
}
