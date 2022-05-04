<?php


class ConnexionDB {

    private static $instance = null;
    private $bdd;

    private function __construct()
    {
      $this->bdd = new PDO("mysql:host=localhost:8889;dbname=grh","root","root", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      // $bdd->query("SET NAMES 'utf8'");
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
