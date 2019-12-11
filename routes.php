<?php

$router->define([
    '/leadGenTool/' =>  require_once __DIR__.'/views/index-view.php',
    '/leadGenTool/add-lead' =>  require_once __DIR__.'/views/add-view.php' 
]);