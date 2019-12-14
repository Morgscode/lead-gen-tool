<?php 

class Router {

    public function direct($uri) {

        switch ($uri) {
            case 'leadGenTool' :
                    require __DIR__ . '/../views/index-view.php';
                break;
            case 'leadGenTool/add-lead' :
                require __DIR__ . '/../views/add-view.php';
                break;
             default:
                http_response_code(404);
                require __DIR__ . '/../views/404.php';
                break;
        }
    }
    
}