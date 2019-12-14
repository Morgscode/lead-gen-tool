<?php 

require __DIR__.'/../controller/LeadController.php';

require __DIR__.'/../template-parts/header.php'; ?>

<?php $lead_controller->creatLead($_POST); ?>


<?php require __DIR__.'/../teplate-parts/footer.php' ;?>