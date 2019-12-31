<section class="pb-4">

    <?php  if ($lead) :  ?>

    <div class="row mb-4 p-4 justify-content-center border-bottom">
        <div class="card col-md-8 col-sm-12 p-4 flex-column" id="current-lead">
            <h3 class="text-bold mb-3"><strong>Company: </strong><span
                    id="current-company-name"><?= $lead->company_name; ?></span>
            </h3>
            <p class="text-bold"><strong>Company contact: </strong><span
                    id="current-company-contact"><?= $lead->company_contact; ?></span>
            </p>
            <p class="text-bold"><strong>Contact role: </strong><span
                    id="current-contact-role"><?= $lead->contact_role; ?></span>
            </p>
            <p class="text-bold"><strong>Contact email: </strong><a
                    href="mailto:<?= $lead->company_contact_email?>"><span
                        id="current-contact-email"><?= $lead->company_contact_email; ?></span></a>
            </p>
        </div>
    </div>

    <?php endif; ?>

</section>