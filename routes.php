<?php

// define routes
$router = new Router();

//define routes
$router->define([
    '/leadGenTool' =>  'views/index-view.php',
    '/leadGenTool/add-lead' =>  'views/add-view.php' 
]);