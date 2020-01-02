<?php require_once __DIR__.'/../server/bootstrap.php';

class NoteController {

    public $db;
    public $query;
    public $statement;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function createNote($newNote) {

        

        if (!empty($newNote) && $newNote == $_REQUEST) : 

           try {
                   $this->query = "INSERT INTO notes (company_id, note_content, note_title) VALUES (:company_id, :note, :note_title)";
                   $this->statement = $this->db->conn->prepare($this->query);
                   $this->statement->bindParam(":company_id", $newNote["companyID"]);
                   $this->statement->bindParam(":note", $newNote["note"]);
                   $this->statement->bindParam(":note_title", $newNote["title"]);

                   var_dump($this->statement);
                
                   $this->statement->execute();

                   echo 'statement executed';
                
                   exit;
                   
            } catch (PDOException $e) {
                
              return $_GLOBALS['message'] = "We're sorry, we couldn't complete that request :/";
              
              exit;
            } 

        endif; 
    }
}

$note_controller = new NoteController($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'addNote') {
    $note_controller->createNote($_REQUEST);
}