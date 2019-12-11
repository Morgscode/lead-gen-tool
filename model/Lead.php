<?php 

class Lead
{
    public $company_name;
    public $company_contact;
    public $company_contact_email;

    public function __construct($name, $contact, $contact_email) {
        $this->company_name = $name;

        $this->company_contact = $contact;

        $this->company_contact_email = $contact_email;
        
    }
}



   