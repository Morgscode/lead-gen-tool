<?php
//define routes
require_once 'Router.php';

//define database connection
require_once 'Database.php';

//instantiate database
$database = new Database();

//connect to database
$dbconn = $database->connect();

//define lead model
require_once 'model/Lead.php';