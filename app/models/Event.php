<?php 

class Event {
    
    public $company_id;
    public $event_title;
    public $event_address;
    public $event_time;
    public $event_date;
    public $event_note;

        public function __construct($newEvent) {
            
            if (!empty($newEvent) && $newEvent = $_REQUEST) :
                
                $this->company_id = filter_var($newEvent['companyID'], FILTER_SANITIZE_STRING);
                $this->event_title = filter_var($newEvent['title'], FILTER_SANITIZE_STRING);
                $this->event_address = filter_var($newEvent['address'], FILTER_SANITIZE_STRING);
                $this->event_time = filter_var($newEvent['time'], FILTER_SANITIZE_STRING);
                $this->event_date = filter_var($newEvent['date'], FILTER_SANITIZE_STRING);
                $this->event_note = filter_var($newEvent['note'], FILTER_SANITIZE_STRING);
              
            endif;
    }
}