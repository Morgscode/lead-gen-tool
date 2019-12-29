<section class="mb-4 pt-4">

    <?php  if ($lead) :  ?>

    <div class="row mb-4 mt-4 justify-content-center border-bottom pb-4">
        <div class="card col-md-8 col-sm-12 p-4 flex-column" id="current-lead">
            <h3 class="text-bold mb-3"><strong>Company: </strong><span class="text-uppercase"
                    id="current-company-name"><?= $lead->company_name; ?></span>
            </h3>
            <p class="text-bold"><strong>Company contact: </strong><span class="text-uppercase"
                    id="current-company-contact"><?= $lead->company_contact; ?></span>
            </p>
            <p class="text-bold"><strong>Contact role: </strong><span class="text-uppercase"
                    id="current-contact-role"><?= $lead->contact_role; ?></span>
            </p>
            <p class="text-bold"><strong>Contact email: </strong><span
                    id="current-contact-email"><?= $lead->company_contact_email; ?></span>
            </p>
        </div>
    </div>

    <?php endif; ?>

</section>