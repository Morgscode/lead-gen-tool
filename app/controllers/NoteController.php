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

    public function createNote($newNote) {

        var_dump($this->db->conn);

        if (!empty($newNote)) :

            var_dump($newNote);

            try {
                $this->query = "INSERT INTO notes (company_id, note_content, note_title) VALUES (:company_id, :note,
                :note_title)";
                $this->statement = $this->db->conn->prepare($this->query);
                $this->statement->bindValue(":company_id", $newNote->company_id);
                $this->statement->bindValue(":note", $newNote->note_title);
                $this->statement->bindValue(":note_title", $newNote->note_content);
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
    
}