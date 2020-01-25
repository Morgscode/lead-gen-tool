<section class="pt-4 mb-4">

    <?php 
    if ($leads) : ?>

    <h2 class="pt-4 mb-4">Your Leads</h2>
    <div class="row leads mb-4 mt-4 pt-4 pb-4 border-bottom">

        <?php  foreach($leads as $lead) : ?>

        <div class="col-lg-4 col-md-6 col-sm-12 lead d-flex flex-column p-2" id="lead-<?= $lead->id ?>">
            <div class="card p-3">
                <h3 style="font-size: 16px;" class="mb-3 font-weight-bold">
                    <?php echo $lead->company_name; ?></h3>
                <p style="font-size: 14px; font-weight: 300;"><strong> Contact:
                    </strong><span class="text-bold"><?php echo $lead->company_contact; ?></span></p>
                <p style="font-size: 14px; font-weight: 300;"><strong> Contact role:
                    </strong><span class="text-bold"><?php echo $lead->contact_role; ?></span></p>
                <p style="font-size: 14px; font-weight: 300;"><strong> Contact email: </strong><a
                        href="mailto:<?php echo $lead->company_contact_email; ?>"><?php echo $lead->company_contact_email; ?></a>
                </p>
                <div class="row p-2 w-100 d-flex justify-content-between">
                    <form action="update-lead" method="get" class="w-25 mr-auto">
                        <input type="hidden" name="id" value="<?= $lead->id?>">
                        <button style="font-size: 14px;" type="submit" class="btn btn-secondary">Update lead</button>
                    </form>
                    <form action="manage-lead" method="get" class="w-25">
                        <input type="hidden" name="id" value="<?= $lead->id?>">
                        <button style="font-size: 14px;" type="submit" class="btn btn-info">Manage lead</button>
                    </form>
                    <form action="delete-lead" method="get" class="w-25 ml-auto">
                        <input type="hidden" name="id" value="<?= $lead->id?>">
                        <button style="font-size: 14px;" type="submit" class="btn btn-danger">Delete lead</button>
                    </form>
                </div>
            </div>
        </div>

        <?php endforeach;

     else : ?>

        <h1 class="text-center mb-4 mt-4 pb-4 pt-4">No leads to show!</h1>

        <?php  endif; ?>

    </div>
</section>