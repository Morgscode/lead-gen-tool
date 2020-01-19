<?php 

require_once __DIR__.'/../server/bootstrap.php';

require_once __DIR__.'/../models/Event.php';

class EventController {

    private $db;
    private $query;
    private $statement;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllEvents($company_id) {

        try {
            
            $this->query = "SELECT * FROM events WHERE :id = company_id ORDER BY created_at DESC";
            
            $this->statement = $this->db->conn->prepare($this->query);
            $this->statement->bindValue(":id", $company_id);
            $this->statement->execute();
            
            $events = $this->statement->fetchAll(PDO::FETCH_OBJ);
         
            echo json_encode($events);

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        } 
     }

    public function createEvent($newEvent) {

        if (!empty($newEvent)) :

            var_dump($newEvent);

            try {
                $this->query = "INSERT INTO events (company_id, event_title, event_address, event_time, event_date, event_note) VALUES (:company_id, :event_title, :event_address, event_time, event_date,
                :event_note)";
                $this->statement = $this->db->conn->prepare($this->query);
                $this->statement->bindValue(":company_id", $newEvent->company_id);
                $this->statement->bindValue(":event_title", $newEvent->event_title);
                $this->statement->bindValue(":event_address", $newEvent->event_address);
                $this->statement->bindValue(":event_time", $newEvent->event_time);
                $this->statement->bindValue(":event_date", $newEvent->event_date);
                $this->statement->bindValue(":event_note", $newEvent->event_note);
                $this->statement->execute();
                
                exit;

            } catch (PDOException $e) {
                var_dump($e->getMessage());
                exit;
            }
        endif;
    }
}

$event_controller = new EventController($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'addEvent') {
    
    $newEvent = new Event($_REQUEST);
    $event_controller->createEvent($newEvent);
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_REQUEST['action'] == 'getEvents') {

    $event_controller->getAllEvents($_REQUEST['id']);
    
}