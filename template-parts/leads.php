<section class="pt-4 mb-4">

    <?php 
    if ($leads) : ?>

    <h2 class="pt-4 mb-4">Your Leads</h2>
    <div class="row leads mb-4 mt-4 pt-4 pb-4 border-bottom">

        <?php  foreach($leads as $lead) : ?>

        <div class="col-lg-4 col-md-6 col-sm-12 lead d-flex flex-column p-2" id="lead-<?= $lead->id ?>">
            <div class="card p-3">
                <h3 style="font-size: 16px;" class="text-uppercase mb-3 font-weight-bold">
                    <?php echo $lead->company_name; ?></h3>
                <p style="font-size: 14px; font-weight: 300;"><strong> contact:
                    </strong><?php echo $lead->company_contact; ?></p>
                <p style="font-size: 14px; font-weight: 300;"><strong> contact role:
                    </strong><?php echo $lead->contact_role; ?></p>
                <p style="font-size: 14px; font-weight: 300;"><strong> contact email: </strong><a
                        href="mailto:<?php echo $lead->company_contact_email; ?>"><?php echo $lead->company_contact_email; ?></a>
                </p>
                <div class="row p-3 w-100 d-flex justify-content-between">
                    <form action="update-lead" method="get">
                        <input type="hidden" name="id" value="<?= $lead->id?>">
                        <button style="font-size: 14px;" type="submit" class="btn btn-secondary">Update lead</button>
                    </form>
                    <form action="delete-lead" method="get">
                        <input type="hidden" name="id" value="<?= $lead->id?>">
                        <button style="font-size: 14px;" type="submit" class="btn btn-danger">Delete lead</button>
                    </form>
                </div>
            </div>
        </div>

        <?php endforeach;

     else : ?>

        <h1 class="text-center mb-4 mt-4 pb-4 pt-4">Non leads to show!</h1>

        <?php  endif; ?>

    </div>
</section>