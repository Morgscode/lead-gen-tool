<?php 

class Database {

  public $host;
  public $dbname;
  public $dbuser;
  public $dbpass;
  public $conn;
  public $query;
  public $statement;
  public $tables;
  public $tableExists;

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

    $this->tableExists = false;

    $tableToEvaluate = strval($tableToEvaluate);

    try {
      
      $this->query = "SHOW TABLES";
      $this->statement = $this->conn->prepare($this->query);
      $dbtable = $this->statement->execute();
      $this->tables = $this->statement->fetchAll(PDO::FETCH_ASSOC);
    
  } catch (\Throwable $th) {
      $_GLOBALS['message'] =  "We're sorry, we couldn't find those leads";
      return $_GLOBALS['message'];
  } 

  if (!empty($this->tables)) :

    foreach($this->tables as $table) {
    
      if ($table['Tables_in_leadgendb'] === $tableToEvaluate) :
       
      $this->tableExists = true;
 
      endif;

    }

  endif;

  }

  public function createTable($table) {

    if ($table === "companies") :

      $this->query = "CREATE TABLE `leadGenDB`.$table ( `id` INT NOT NULL AUTO_INCREMENT , `company_name` VARCHAR(255) NOT NULL , `company_contact` VARCHAR(255) NOT NULL , `contact_role` VARCHAR(255) NOT NULL , `company_contact_email` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";

    endif;

     try {

      $this->statement = $this->conn->prepare($this->query);
      $dbtable = $this->statement->execute(); 
      
     } catch (\Throwable $th) {
       
      $_GLOBALS['message'] =  "We couldn't instantiate that databse :/";

     }

  

  }
  
}


  
  