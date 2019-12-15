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
            case 'leadGenTool/lead-created' :
                    require __DIR__ . '/../views/lead-created-view.php';
                break;
            case 'leadGenTool/update-lead' :
                    require __DIR__ . '/../views/update-view.php';
                break;
            case 'leadGenTool/delete-lead' :
                    require __DIR__ . '/../views/delete-view.php';
            break;
             default:
                http_response_code(404);
                    require __DIR__ . '/../views/404.php';
            break;
        }
    }
    
}