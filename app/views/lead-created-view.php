<?php 

require_once __DIR__.'/../controller/LeadController.php';

require __DIR__.'/../../template-parts/header.php'; ?>

<?php if (isset($message)) : ?>
<h1><?= $message ?></h1>
<?php else : ?>
<h2 class="mt-4">Your lead has been added to the databse!</h2>
<div class="row mt-4 mb-4 border-bottom" style="height: 400px">
    <div class="col-6 d-flex justify-content-center align-items-center">
        <a href="/leadGenTool" class="btn btn-success">Return to home</a>
    </div>
    <div class="col-6 d-flex justify-content-center align-items-center">
        <a href="/leadGenTool/add-lead" class="btn btn-secondary">Add Another Lead</a>
    </div>
</div>
<?php endif ?>

<?php require __DIR__.'/../../template-parts/footer.php' ;?>