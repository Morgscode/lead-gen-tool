<?php require_once __DIR__.'/../controllers/LeadController.php';

require_once __DIR__.'/../../public/template-parts/header.php'; ?>

<?php require_once __DIR__.'/../../public/template-parts/lead-single.php'; ?>

<section class="pb-4">
    <h3 class="mb-4">Update your lead details by selecting the fields you wish to update</h3>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <form action="lead-updated" method="post" class="form p-4 card  bg-dark text-light" id="update-lead-form"
                data-company-id="<?= $lead->id; ?>">
                <i class="fas fa-times close-field d-none"></i>
                <input type="hidden" name="id" value="<?= $lead->id?>">
                <input type="hidden" name="_method" value="update">
                <h4>Update <?= $lead->company_name; ?></h4>
                <div class="form-group" id="update-form-fields"></div>
                <div class="row ml-0 mr-0 d-none" id="update-buttons">
                    <button type="button" id="cancel-update" class="btn btn-secondary">Cancel</button>
                    <button type="submit" id="update-lead" class="btn btn-success ml-auto">Update
                        <?= $lead->company_name ?></button>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card p-4  bg-dark text-light">
                <button id="company-name" class="btn btn-secondary form-control mb-3">Company name</button>
                <button id="contact-name" class="btn btn-secondary form-control mb-3">Company contact</button>
                <button id="contact-role" class="btn btn-secondary form-control mb-3">Contact role</button>
                <button id="contact-email" class="btn btn-secondary form-control">Company contact
                    email</button>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__.'/../../public/template-parts/footer.php'; ?>