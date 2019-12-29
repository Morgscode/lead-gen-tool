<?php 

class Lead
{
    public $company_name;
    public $company_contact;
    public $contact_role;
    public $company_contact_email;

    public function __construct($lead) {
        if (!empty($lead) && $lead = $_POST) :
            $this->company_name  = filter_var($lead['company-name'], FILTER_SANITIZE_STRING);
            $this->company_contact = filter_var($lead['contact-name'], FILTER_SANITIZE_STRING);
            $this->contact_role = filter_var($lead['contact-role'], FILTER_SANITIZE_STRING);
            $this->company_contact_email = filter_var($lead['company-contact-email'],FILTER_SANITIZE_STRING);
        endif;
    }
}



   