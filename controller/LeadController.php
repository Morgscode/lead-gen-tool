<?php

require __DIR__.'/../server/bootstrap.php';

class LeadController {

    public $db;
    public $dbconn;
   
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

            $query = 'INSERT INTO companies (company_name, company_contact, company_contact_email) VALUES (:company_name, :company_contact, :compnay_contant_email)';

            $statement = $this->db->conn->prepare($query);
            
            $statement->bindParam(':company_name', $company_name, PDO::PARAM_STR);
            $statement->bindParam(':company_contact', $company_contact, PDO::PARAM_STR);
            $statement->bindParam(':company_contant_email', $company_contact_email, PDO::PARAM_STR);

            $statement->execute();

         } catch (PDOException $e) {
             
           $message = 'Sorry! We couldn\'t complete that request :/'.$e->getMessage();

           return $message;
           
         }
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