<?php 

require_once __DIR__.'/../server/bootstrap.php';

class NoteController {

private $db;
private $query;
private $statement;

public function __construct($db) {
    $this->db = $db;
    $this->db->connectToLeadGenDatabase();
}

public function createNote($newNote) {

if (!empty($newNote) && $newNote == $_REQUEST) :

try {
var_dump(' try runs');
$this->query = "INSERT INTO notes (company_id, note_content, note_title) VALUES (:company_id, :note,
:note_title)";
var_dump('query assignment runs', $this->query);
$this->statement = $this->db->conn->prepare($this->query);
var_dump('prepare runs');
$this->statement->bindValue(":company_id", $newNote["companyID"]);
var_dump('bind id runs');
$this->statement->bindValue(":note", $newNote["note"]);
var_dump('bind note runs');
$this->statement->bindValue(":note_title", $newNote["title"]);
var_dump('bind title runs', $this->statement);
$this->statement->execute();
var_dump('execute runs');

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