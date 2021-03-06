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

    public function getAllMeetings($company_id) {

        try {
            
            $this->query = "SELECT * FROM meetings WHERE :id = company_id ORDER BY created_at DESC";
            
            $this->statement = $this->db->conn->prepare($this->query);
            $this->statement->bindValue(":id", $company_id);
            $this->statement->execute();
            
            $meetings = $this->statement->fetchAll(PDO::FETCH_OBJ);
         
            echo json_encode($meetings);

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
                $this->statement->bindValue(":meeting_title", $newMeeting->meeting_title);
                var_dump('bind title runs');
                $this->statement->bindValue(":meeting_address", $newMeeting->meeting_address);
                var_dump('bind address runs');
                $this->statement->bindValue(":meeting_time", $newMeeting->meeting_time);
                var_dump('bind time runs');
                $this->statement->bindValue(":meeting_date", $newMeeting->meeting_date);
                var_dump('bind date runs');
                $this->statement->bindValue(":meeting_note", $newMeeting->meeting_note);
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
    
    $newMeeting = new Meeting($_REQUEST);
    $meeting_controller->createMeeting($newMeeting);
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_REQUEST['action'] == 'getMeetings') {

    $meeting_controller->getAllMeetings($_REQUEST['id']);
}