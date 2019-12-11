<?php 

class Database {

  public $host;
  public $dbname;
  public $dbuser;
  public $dbpass;
  public $conn;

  public function __construct() {
    $this->host = 'localhost';
    $this->dbname = 'leadGenDB';
    $this->dbuser = 'root';
    $this->dbpass = 'root';
  }

  public function connect() {
    //pdo connection
    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->dbpass);
    } catch (PDOException $e) {
      echo 'could not connect to database :/ '.$e->getMessage;
    }
  }
}


  
  