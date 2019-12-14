<?php

require __DIR__.'/../server/bootstrap.php';

//define lead model
require __DIR__.'/../model/Lead.php';

class LeadController {

    private $db;
   
    public function __construct($db) {
        $this->db = $db;
     }

     public function getAllLeads() {

        try {
            $query = 'SELECT * FROM companies';
            $statement = $this->db->conn->prepare($query);
            $statement->execute();
   
            return $leads = $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            $message =  'We\'re sorry, we couldn\t find those leads';
            return $message;
        } 

     }

     public function createLead($newLead) {
         $company_name  = $newLead['company-name'];
         $company_contact = $newLead['contact-name'];
         $compnay_contant_email = $newLead['company-contact-email'];

         try {
            $query = 'INSERT INTO companies (company_name, company_contact, company_contact_email) VALUES ($company_name, $company_contact, $compnay_contant_email)';
            $statement = $this->db->conn->prepare($query);
            $statement->execute();

            $message = 'Your lead has been added to the database!';
            return $message;

         } catch (\Throwable $th) {
             
            $message = 'Sorry! We couldn\'t complete that request :/';
            return $message;
         }

     }
     
}

//instantiate lead controller
$lead_controller = new LeadController($database);


// set actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lead_controller->createLead($_POST);
   
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
   
    $leads = $lead_controller->getAllLeads();

}