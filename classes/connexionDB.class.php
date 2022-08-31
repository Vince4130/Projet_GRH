<?php


class ConnexionDB {

    private static $instance = null;
    private $bdd;
    public $host   = "localhost";
    public $port   = 3308;
    public $dbname ="grh";
    public $user   = "vince";
    public $mpd    = "bitonio";

    private function __construct()
    {
      try {
        $this->bdd = new PDO("mysql:host=".$this->host.":".$this->port.";dbname=".$this->dbname.";charset=UTF8",$this->user,$this->mdp, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      }
      catch (PDOException $e) {
        echo "Echec connexion base de données ".$this->dbname." : ", $e->getMessage();
        return false;
        exit();
      }
       
    }

    public static function getInstance()
    {
      if(!self::$instance)
      {
        self::$instance = new ConnexionDB();
      }
  
      return self::$instance;
    }

    public function getConnection()
    {
      return $this->bdd;   
    }
}
