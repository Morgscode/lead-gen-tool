<?php 

// store request address
$uri = trim($_SERVER['REQUEST_URI']);

//define router class
require_once 'server/Router.php';

//instantiate router
$router = new Router();

//direct http requests
$router->direct($uri);