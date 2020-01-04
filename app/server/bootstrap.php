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

//enable cors
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}