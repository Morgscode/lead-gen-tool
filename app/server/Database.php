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
  public $dbExists;
  public $databases;

  public function __construct() {
    $this->host = 'localhost';
    $this->dbname = 'leadGenDB';
    $this->dbuser = 'root';
    $this->dbpass = 'root';
  }

  public function connect() {
    //pdo connection
    try {
      $this->conn = new PDO("mysql:host=$this->host;", $this->dbuser, $this->dbpass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'could not connect to database :/ '.$e->getMessage;
    }
  }

  public function evaluateLeadGenDB() {

    $this->dbExists = false;

    try {
      
      $this->query = "SHOW DATABASES";
      $this->statement = $this->conn->prepare($this->query);
      $this->statement->execute();
      $this->databases = $this->statement->fetchAll(PDO::FETCH_ASSOC);
    
  } catch (PDOException $e) {
     echo 'we couldn\'t find any databases on the server :/ '.$e->getMessage;
  } 

  if (!empty($this->databases)) :

    foreach($this->databases as $database) {

      if ($this->dbExists == false) : 
    
      ($database['Database'] === 'leadGenDB') ? $this->dbExists = true : $this->dbExists = false;

      endif;
       
    }
    
  endif;

  }

  public function connectToLeadGenDatabase() {

    $this->dbExists = true;

    try {
          $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->dbpass);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
          echo 'could not connect to database :/ '.$e->getMessage;
    }
}

  public function createLeadGenDatabase() {

    try {
      
      $this->query = "CREATE DATABASE leadGenDB";
      $this->statement = $this->conn->prepare($this->query);
      $this->statement->execute(); 
      
     } catch (PDOException $e) {
       
      echo "We couldn't instantiate that databse :/ ".$e->getMessage();

     }

     $this->connectToLeadGenDatabase();
    
  }

  public function evaluateTable($tableToEvaluate) {

    $this->tableExists = false;

    $tableToEvaluate = strval($tableToEvaluate);

    try {
      
      $this->query = "SHOW TABLES";
      $this->statement = $this->conn->prepare($this->query);
      $this->statement->execute();
      $this->tables = $this->statement->fetchAll(PDO::FETCH_ASSOC);
    
  } catch (PDOException $e) {
     echo "We couldn't find any tables in the database :/ ".$e->getMessage();
  } 

  if (!empty($this->tables)) :

    foreach($this->tables as $table) {

      if ($this->tableExists == false) : 

      ($table['Tables_in_leadgendb'] == $tableToEvaluate) ? $this->tableExists = true : $this->tableExists = false;

      endif;
    
    }

  endif;

  }

  public function createTable($table) {

    if ($table === "companies"):

      $this->query = "CREATE TABLE companies ( `id` INT NOT NULL AUTO_INCREMENT , `company_name` VARCHAR(255) NOT NULL , `company_contact` VARCHAR(255) NOT NULL , `contact_role` VARCHAR(255) NOT NULL , `company_contact_email` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
      
    elseif ($table === "notes"):

      $this->query = "CREATE TABLE `leadGenDB`.`notes` ( `id` INT NOT NULL AUTO_INCREMENT , `company_id` INT NOT NULL , `note_title` VARCHAR(255) NOT NULL , `note_content` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
      

      elseif ($table === "events"):

        $this->query = "CREATE TABLE `leadGenDB`.`events` ( `id` INT NOT NULL AUTO_INCREMENT , `company_id` INT NOT NULL , `event_title` VARCHAR(255) NOT NULL , `event_address` VARCHAR(255) NOT NULL , `event_time` VARCHAR(255) NOT NULL , `event_date` VARCHAR(255) NOT NULL , `event_note` MEDIUMTEXT NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    else: 

      echo 'I can\'t create that table boss :/';

    endif; 
      
     try {

      $this->statement = $this->conn->prepare($this->query);
 
      $this->statement->execute(); 
      
     } catch (PDOException $e) {
       
      echo "There was a problem creating one of the necessary db tables :/ ".$e->getMessage();

     }
  }  
}


  
  