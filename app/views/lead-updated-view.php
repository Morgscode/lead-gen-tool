<?php 

require_once __DIR__.'/../controller/LeadController.php';

require __DIR__.'/../../public/template-parts/header.php'; ?>

<h1 class="mb-4 text-center pt-4">Your lead "<?= $currentLead->company_name ?>" has been updated!</h1>

<div class="mb-4 mt-4 col-12 d-flex justify-content-center align-items-center">
    <a href="/leadGenTool" class="btn btn-success">Return to home</a>
</div>

<?php require __DIR__.'/../../public/template-parts/footer.php' ?>