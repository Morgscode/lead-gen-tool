<section>
    <h2 class="lead-heading mt-4 mb-4">Your Leads</h2>
    <div class="row leads mb-4 mt-4 p-3">
        <?php 
    $leads = $lead_controller->getAllLeads();
        
    foreach($leads as $lead) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12 lead card d-flex flex-column p-3">
            <h3><?php echo $lead->company_name; ?></h3>
            <p>contact:<?php echo $lead->company_contact; ?></p>
            <p>contact email:<?php echo $lead->company_contact_email; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>