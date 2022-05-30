<?php


class ConnexionDB {

    private static $instance = null;
    private $bdd;

    private function __construct()
    {
      $this->bdd = new PDO("mysql:host=localhost:8889;dbname=grh_dev;charset=UTF8","root","root", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      
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
