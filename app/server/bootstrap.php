<?php
//define database connection
require_once 'Database.php';

//instantiate database
$database = new Database();

//connect to database
$dbconn = $database->connect();

//evaluate if leadGenDB exists
$database->evaluateLeadGenDB();

if ($database->dbExists === false ) : 
//create db if !exists
$database->createLeadGenDatabase();

endif;

//evaluate if companies table exists in leadGenDB
$database->evaluateTable("companies");

if ($database->tableExists === false) : 
    
    $database->createTable("companies");

endif;