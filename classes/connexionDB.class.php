<?php


class ConnexionDB {

    private static $instance = null;
    private $bdd;

    private function __construct()
    {
      $this->bdd = new PDO("mysql:host=localhost:3306;dbname=grh;charset=UTF8","vince","413083", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      
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
