<?php 

class UpdatedLead {
    
    public $company_name;
    public $company_contact;
    public $contact_role;
    public $company_contact_email;
    public $id;

    public function __construct($updatedLead) {
        $this->id = $updatedLead['id'];
        if (isset($updatedLead) && !empty($updatedLead) && $updatedLead == $_POST ) : 
            if (!empty($updatedLead['company-name']) && $updatedLead == $_POST) : 
                $this->company_name = filter_var($updatedLead['company-name'], FILTER_SANITIZE_STRING);
            endif;
            if (!empty($updatedLead['contact-name']) && $updatedLead == $_POST): 
                $this->company_contact = filter_var($updatedLead['contact-name'], FILTER_SANITIZE_STRING);
            endif;
            if (!empty($updatedLead['contact-role']) && $updatedLead == $_POST) : 
                $this->contact_role = filter_var($updatedLead['contact-role'], FILTER_SANITIZE_STRING);
            endif;
            if (!empty($updatedLead['company-contact-email']) && $updatedLead == $_POST) : 
                $this->company_contact_email = filter_var($updatedLead['company-contact-email'],FILTER_SANITIZE_STRING);
            endif;
        endif;
    }
    
}