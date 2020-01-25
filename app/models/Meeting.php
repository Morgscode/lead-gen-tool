<?php 

class Meeting {
    
    public $company_id;
    public $meeting_title;
    public $meeting_address;
    public $meeting_time;
    public $meeting_date;
    public $meeting_note;

        public function __construct($newMeeting) {
            
            if (!empty($newMeeting) && $newMeeting = $_REQUEST) :
                
                $this->company_id = filter_var($newMeeting['companyID'], FILTER_SANITIZE_STRING);
                $this->meeting_title = filter_var($newMeeting['title'], FILTER_SANITIZE_STRING);
                $this->meeting_address = filter_var($newMeeting['address'], FILTER_SANITIZE_STRING);
                $this->meeting_time = filter_var($newMeeting['time'], FILTER_SANITIZE_STRING);
                $this->meeting_date = filter_var($newMeeting['date'], FILTER_SANITIZE_STRING);
                $this->meeting_note = filter_var($newMeeting['note'], FILTER_SANITIZE_STRING);
              
            endif;
    }
}