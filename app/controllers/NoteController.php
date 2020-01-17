<?php 

require_once __DIR__.'/../server/bootstrap.php';

require_once __DIR__.'/../models/Note.php';

class NoteController {

    private $db;
    private $query;
    private $statement;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllNotes($company_id) {

        try {
            
            $this->query = "SELECT id, note_title, note_content FROM notes WHERE :id = company_id";
            
            $this->statement = $this->db->conn->prepare($this->query);
            $this->statement->bindValue(":id", $company_id);
            $this->statement->execute();
            
            $notes = $this->statement->fetchAll(PDO::FETCH_OBJ);
         
            echo json_encode($notes);

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        } 

     }

    public function createNote($newNote) {

        if (!empty($newNote)) :

            var_dump($newNote);

            try {
                $this->query = "INSERT INTO notes (company_id, note_content, note_title) VALUES (:company_id, :note,
                :note_title)";
                $this->statement = $this->db->conn->prepare($this->query);
                $this->statement->bindValue(":company_id", $newNote->company_id);
                $this->statement->bindValue(":note", $newNote->note_conent);
                $this->statement->bindValue(":note_title", $newNote->note_title);
                $this->statement->execute();
                
                exit;

            } catch (PDOException $e) {

                var_dump($e->getMessage());

                exit;

            }

        endif;

    }
}

$note_controller = new NoteController($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'addNote') {

    $newNote = new Note($_REQUEST);
    $note_controller->createNote($newNote);
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_REQUEST['action'] == 'getNotes') {

    $note_controller->getAllNotes($_REQUEST['id']);
    
}