<?php
//define database connection
require_once 'Database.php';

//instantiate database
$database = new Database();

//connect to db server
$database->connect();

//evaluate if leadGenDB exists
$database->evaluateLeadGenDB();

if ($database->dbExists === false ) : 
//create db if (!exists) and connect
$database->createLeadGenDatabase();

else : 
// connect to db if (exists)
$database->connectToLeadGenDatabase();

endif;

//evaluate if companies table exists in leadGenDB
$database->evaluateTable("companies");

if ($database->tableExists === false) : 
    
    $database->createTable("companies");

endif;

//evaulate if notes table exists in leadGenDB
$database->evaluateTable("notes");

if ($database->tableExists === false) : 
    
    $database->createTable("notes");

endif;


//evaulate if notes table exists in leadGenDB
$database->evaluateTable("events");

if ($database->tableExists === false) : 
    
    $database->createTable("events");

endif;

$database->evaluateTable("meetings");

if ($database->tableExists === false) : 
    
    $database->createTable("meetings");

endif;