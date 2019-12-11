<?php

$router->define([
    '/leadGenTool/' =>  require_once __DIR__.'/views/index-view.php',
    '/leadGenTool/addlead' =>  require_once __DIR__.'/views/add-view.php' 
]);