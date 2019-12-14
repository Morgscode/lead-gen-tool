<?php 

// store request address
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

//define router class
require_once 'server/Router.php';

//instantiate router
$router = new Router();

//direct http requests
$router->direct($uri);