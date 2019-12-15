<?php

require __DIR__.'/../server/bootstrap.php';

class LeadController {

    public $db;
   
    public function __construct($db) {
        $this->db = $db;
     }

     public function getAllLeads() {

        try {
            $query = "SELECT * FROM companies";
            $statement = $this->db->conn->prepare($query);
            $statement->execute();
   
            return $leads = $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            $message =  "We're sorry, we couldn't find those leads";
            return $message;
        } 

     }

     public function createLead($newLead) {

         if ($newLead == $_POST && !empty($_POST)) : 

            $company_name  = $newLead["company-name"];
            $company_contact = $newLead["contact-name"];
            $company_contact_email = $newLead["company-contact-email"];

            try {

                if (isset($newLead['submission'])) : 

                    $query = "INSERT INTO companies (company_name, company_contact, company_contact_email) VALUES (:company_name, :company_contact, :company_contact_email)";
                
                    $statement = $this->db->conn->prepare($query);
                
                    $statement->bindValue(":company_name", $company_name);
                    $statement->bindValue(":company_contact", $company_contact);
                    $statement->bindValue(":company_contact_email", $company_contact_email);
        
                    $statement->execute();
                    
                    header("Location: lead-created");
                    
                endif;

             } catch (PDOException $e) {
                 
               $message = "Sorry! We couldn't complete that request :/".$e->getMessage();

               header("Location: lead-created");
    
             }

         endif;
      
     }  
}

//instantiate lead controller
$lead_controller = new LeadController($database);

// set actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lead_controller->createLead($_POST);
   
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
   
    $leads = $lead_controller->getAllLeads();

}