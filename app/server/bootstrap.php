<?php
//define database connection
require_once 'Database.php';

//instantiate database
$database = new Database();

//connect to database
$dbconn = $database->connect();

$database->evaluateTable("companies");

var_dump($database->tableExists);

if ($database->tableExists == false) : 
    
    $database->createTable("companies");

endif;