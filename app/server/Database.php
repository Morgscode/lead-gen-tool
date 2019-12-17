<?php 

class Database {

  public $host;
  public $dbname;
  public $dbuser;
  public $dbpass;
  public $conn;
  public $query;
  public $statement;

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
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'could not connect to database :/ '.$e->getMessage;
    }
  }

  public function evaluateTable($tableToEvaluate) {

    $tableToEvaluate = strval($tableToEvaluate);

    try {
      
      $this->query = "SHOW TABLES";
      $this->statement = $this->conn->prepare($this->query);
      $dbtable = $this->statement->execute();
      $tables = $this->statement->fetchAll(PDO::FETCH_OBJ);
      
      foreach($tables as $table) {
        if (strval($table->Tables_in_leadgendb) === $tableToEvaluate ) :
           
          echo $table->Tables_in_leadgendb.'<br/>';
          return;
        else : 
          //crate table in db -> switch statement
        endif;
      }

  } catch (\Throwable $th) {
      $_GLOBALS['message'] =  "We're sorry, we couldn't find those leads";
      return $_GLOBALS['message'];
  } 

  }
}


  
  