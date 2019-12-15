<?php

require_once __DIR__.'/../server/bootstrap.php';

require_once __DIR__.'/../model/Lead.php';

class LeadController {

    private $db;
   
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

         if (!empty($newLead)) : 

            try {
                    $query = "INSERT INTO companies (company_name, company_contact,contact_role, company_contact_email) VALUES (:company_name, :company_contact, :contact_role, :company_contact_email)";
                
                    $statement = $this->db->conn->prepare($query);
                
                    $statement->bindValue(":company_name", $newLead->company_name);
                    $statement->bindValue(":company_contact", $newLead->company_contact);
                    $statement->bindValue(":contact_role", $newLead->contact_role);
                    $statement->bindValue(":company_contact_email", $newLead->company_contact_email);
        
                    $statement->execute();
                    
                    header("Location: lead-created");
                    
             } catch (PDOException $e) {
                 
               $_GLOBALS['message'] = "We're sorry, we couldn't complete that request :/".$e->getMessage();
               header("Location: lead-created");
             } 

         endif; 
     }

     public function getSingleLead($id) {

        if (isset($id) && $id == $_GET['id']) : 

            try {
                $query = "SELECT * FROM companies WHERE id=:id";
                $statement = $this->db->conn->prepare($query);
                $statement->bindValue(":id", $id);

                $statement->execute();

                return $lead = $statement->fetch(PDO::FETCH_OBJ);
                
            } catch (\Throwable $th) {
                $_GLOBALS['message'] =  "We're sorry, we couldn't find those leads";
            } 
          
        endif;    

     }

     public function deleteLead($id) {

            try {
                $query = "DELETE FROM companies WHERE id=:id";
                $statement = $this->db->conn->prepare($query);
                $statement->bindValue(":id", $id);

                $statement->execute();

                header("Location: /leadGenTool");
                exit;

            } catch (\Throwable $th) {

                $_GLOBALS['message'] =  "We're sorry, we couldn't delete that lead from the database";
            } 

            header("Location:  ");
     }  
}
    
//instantiate lead controller
$lead_controller = new LeadController($database);

// set controller actions
if  ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'delete') {

    $lead_controller->deleteLead($_POST['id']);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET['id'])) {
   
    $leads = $lead_controller->getAllLeads();

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && empty($_GET['_method'])) {

    $lead = $lead_controller->getSingleLead($_GET['id']);

}  elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newLead = new Lead($_POST);

    $lead_controller->createLead($newLead);

}