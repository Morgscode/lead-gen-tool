<?php 
//boostrap app
require_once 'server/bootstrap.php';

// define routes
$router = new Router();

// define routes
require_once 'routes.php';

$uri = $_SERVER['REQUEST_URI'];

var_dump($uri);

$router->direct($uri);