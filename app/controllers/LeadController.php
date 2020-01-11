<?php

require_once __DIR__.'/../server/bootstrap.php';

require_once __DIR__.'/../models/Lead.php';

require_once __DIR__.'/../models/UpdatedLead.php';

class LeadController {

    private $db;
    private $query;
    private $statement;
   
    public function __construct($db) {
        $this->db = $db;
     }

      public function getAllLeads() {

        try {
            $this->query = "SELECT * FROM companies";
            $this->statement = $this->db->conn->prepare($this->query);
            $this->statement->execute();
   
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        } 

     }

     public function createLead($newLead) {

         if (!empty($newLead)) : 

            try {
                    $this->query = "INSERT INTO `companies` (company_name, company_contact,contact_role, company_contact_email) VALUES (:company_name, :company_contact, :contact_role, :company_contact_email)";
                    $this->statement = $this->db->conn->prepare($this->query);
                    $this->statement->bindValue(":company_name", $newLead->company_name);
                    $this->statement->bindValue(":company_contact", $newLead->company_contact);
                    $this->statement->bindValue(":contact_role", $newLead->contact_role);
                    $this->statement->bindValue(":company_contact_email", $newLead->company_contact_email);
                    $this->statement->execute();
                    
                    header("Location: lead-created");
                    exit;
                    
             } catch (PDOException $e) {
                 
               header("Location: lead-created");
               var_dump($e->getMessage());
               exit;
             } 

         endif; 
     }

     public function getSingleLead($id) {

        if (isset($id)) : 

            try {
                $this->query = "SELECT * FROM companies WHERE id=:id";
                $this->statement = $this->db->conn->prepare($this->query);
                $this->statement->bindValue(":id", $id);
                $this->statement->execute();

                return $lead = $this->statement->fetch(PDO::FETCH_OBJ);
                
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            } 
          
        endif;    

     }

     public function deleteLead($id) {

            try {
                $this->query = "DELETE FROM companies WHERE id=:id";
                $this->statement = $this->db->conn->prepare($this->query);
                $this->statement->bindValue(":id", $id);
                $this->statement->execute();

                header("Location: /leadGenTool");
                exit;

            } catch (PDOException $e) {

                var_dump($e->getMessage());
            } 

            header("Location:  ");
     }
     
     public function updateLead($updatedLead, $currentLead) {

        try {
            
            $this->query = "UPDATE companies SET company_name=:company_name, company_contact=:company_contact, contact_role=:contact_role, company_contact_email=:company_contact_email WHERE id=:id";
            $this->statement = $this->db->conn->prepare($this->query);

            ($updatedLead->company_name !== NULL) ? $this->statement->bindValue(':company_name', $updatedLead->company_name) : $this->statement->bindValue(':company_name', $currentLead->company_name);
                
        
            ($updatedLead->company_contact !== NULL) ?  $this->statement->bindValue(':company_contact', $updatedLead->company_contact) : $this->statement->bindValue(':company_contact', $currentLead->company_contact);
          

            ($updatedLead->contact_role !== NULL) ?  $this->statement->bindValue(':contact_role', $updatedLead->contact_role) : $this->statement->bindValue(':contact_role', $currentLead->contact_role);
           
            ($updatedLead->company_contact_email !== NULL) ? $this->statement->bindValue(':company_contact_email', $updatedLead->company_contact_email) : $this->statement->bindValue(':company_contact_email', $currentLead->company_contact_email);
           
            $this->statement->bindValue(':id', $currentLead->id);

            $this->statement->execute();   

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
 
     }
}
    
// instantiate lead controller
$lead_controller = new LeadController($database);

// set controller actions
if  ( $_POST['_method'] && !empty($_POST['_method']) && $_POST['_method'] === 'delete') {

    $lead_controller->deleteLead($_POST['id']);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET['id'])) {
   
    $leads = $lead_controller->getAllLeads();

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && empty($_GET['_method'])) {

    $lead = $lead_controller->getSingleLead($_GET['id']);

}  elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && !empty($_POST) && empty($_POST['_method']) ) {

    $newLead = new UpdatedLead($_POST);
    $lead_controller->createLead($newLead);
    
} elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && !empty($_POST) && !empty($_POST['_method']) && $_POST['_method'] === 'update' ) {
    
    $newUpdatedLead = new UpdatedLead($_POST);
    $currentLead = $lead_controller->getSingleLead($newUpdatedLead->id);
    $lead_controller->updateLead($newUpdatedLead, $currentLead);

}