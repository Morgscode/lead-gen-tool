<section class="mt-4 mb-4">

    <?php 
    if ($leads) : ?>

    <h2 class="mt-4 mb-4">Your Leads</h2>
    <div class="row leads mb-4 mt-4 pt-4 pb-4 border-bottom">

        <?php  foreach($leads as $lead) : ?>

        <div class="col-lg-4 col-md-6 col-sm-12 lead d-flex flex-column p-2" id="lead-<?= $lead->id ?>">
            <div class="card p-2">
                <h3 class="text-uppercase mb-3 font-weight-bold"><?php echo $lead->company_name; ?></h3>
                <p><strong> contact: </strong><?php echo $lead->company_contact; ?></p>
                <p><strong> contact email: </strong><a
                        href="mailto:<?php echo $lead->company_contact_email; ?>"><?php echo $lead->company_contact_email; ?></a>
                </p>
            </div>
        </div>

        <?php endforeach;

     else : ?>

        <h1>We're sorry, we couldn't fetch your leads from the database</h1>

        <?php  endif; ?>

    </div>
</section>