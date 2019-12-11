<?php

class LeadController {

    private $db;
   
    public function __construct($db) {
        $this->db = $db;
     }

     public function getAllLeads() {
         $query = 'SELECT * FROM companies';
         $statement = $this->db->conn->prepare($query);
         $statement->execute();

         return $leads = $statement->fetchAll(PDO::FETCH_OBJ);
     }

     public static function createLead($newLead) {
         $company_name  = $newLead->company_name;
         $company_contact = $newLead->company_contact;
         $compnay_contant_email = $newLead->compnay_contant_email;
     }
     
}

//instantiate lead controller
$lead_controller = new LeadController($database);