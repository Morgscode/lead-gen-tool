<?php 

require_once __DIR__.'/../server/bootstrap.php';

require_once __DIR__.'/../models/Meeting.php';

class MeetingController {

    private $db;
    private $query;
    private $statement;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMeeting($company_id) {

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

    public function createMeeting($newMeeting) {

        if (!empty($newMeeting)) :

            var_dump($newMeeting);

            try {
                $this->query = "INSERT INTO meetings (company_id, meeting_title, meeting_address, meeting_time, meeting_date, meeting_note) VALUES (:company_id, :meeting_title, :meeting_address, :meeting_time, :meeting_date,
                :meeting_note)";
                $this->statement = $this->db->conn->prepare($this->query);
                $this->statement->bindValue(":company_id", $newMeeting->company_id);
                var_dump('bind id runs');
                $this->statement->bindValue(":event_title", $newMeeting->event_title);
                var_dump('bind title runs');
                $this->statement->bindValue(":event_address", $newMeeting->event_address);
                var_dump('bind address runs');
                $this->statement->bindValue(":event_time", $newMeeting->event_time);
                var_dump('bind time runs');
                $this->statement->bindValue(":event_date", $newMeeting->event_date);
                var_dump('bind date runs');
                $this->statement->bindValue(":event_note", $newMeeting->event_note);
                var_dump('bind note runs');
                $this->statement->execute();
                var_dump('execute runs');
                
                exit;

            } catch (PDOException $e) {
                var_dump($e->getMessage());
                exit;
            }
        endif;
    }
}

$meeting_controller = new MeetingController($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'addMeeting') {
    
    $newMeeting = new Event($_REQUEST);
    $meeting_controller->createEvent($newMeeting);
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_REQUEST['action'] == 'getMeetings') {

    $meeting_controller->getAllMeetings($_REQUEST['id']);
}