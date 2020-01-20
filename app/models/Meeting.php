<?php 

class Meeting {
    
    public $company_id;
    public $event_title;
    public $event_address;
    public $event_time;
    public $event_date;
    public $event_note;

        public function __construct($newMeeting) {
            
            if (!empty($newMeeting) && $newMeeting = $_REQUEST) :
                
                $this->company_id = filter_var($newMeeting['companyID'], FILTER_SANITIZE_STRING);
                $this->event_title = filter_var($newMeeting['title'], FILTER_SANITIZE_STRING);
                $this->event_address = filter_var($newMeeting['address'], FILTER_SANITIZE_STRING);
                $this->event_time = filter_var($newMeeting['time'], FILTER_SANITIZE_STRING);
                $this->event_date = filter_var($newMeeting['date'], FILTER_SANITIZE_STRING);
                $this->event_note = filter_var($newMeeting['note'], FILTER_SANITIZE_STRING);
              
            endif;
    }
}