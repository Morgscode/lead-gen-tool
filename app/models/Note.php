<?php 

class Note
{
    public $company_id;
    public $note_title;
    public $note_content;
   
    public function __construct($newNote) {
        if (!empty($newNote) && $newNote = $_REQUEST) :
            var_dump($newNote);
            $this->company_id  = filter_var($newNote['companyID'], FILTER_SANITIZE_STRING);
            $this->note_title = filter_var($newNote['title'], FILTER_SANITIZE_STRING);
            $this->note_content = filter_var($newNote['note'], FILTER_SANITIZE_STRING);
        endif;
    }
}