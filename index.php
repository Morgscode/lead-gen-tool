<?php 
//boostrap app
require_once 'server/bootstrap.php';

// define routes
require_once 'routes.php';

$uri = $_SERVER['REQUEST_URI'];

$router->direct($uri);