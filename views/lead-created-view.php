<?php 

require_once __DIR__.'/../controller/LeadController.php';

require __DIR__.'/../template-parts/header.php'; ?>

<?php if (isset($message)) : ?>
<h1><?= $message ?></h1>
<?php else : ?>
<h2 class="mt-4">Your lead has been added to the databse!</h2>
<?php endif ?>



<?php require __DIR__.'/../template-parts/footer.php' ;?>