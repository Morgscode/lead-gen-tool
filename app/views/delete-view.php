<?php 

require_once __DIR__.'/../controller/LeadController.php';

require_once __DIR__.'/../../public/template-parts/header.php'; 

require_once __DIR__.'/../../public/template-parts/lead-single.php'; ?>

<?php if($lead) : ?>

<h3 class="mt-4 mb-4">Warning this cannot be undone! Are you sure you want to delete <?= $lead->company_name; ?></h3>
<div class="row">
    <form method="post" class="form col-md-4 col-sm-12" id="delete-lead-<?= $lead->id; ?>">
        <div class="form-group card p-4">
            <label for="delete">Yes I'm sure,</label>
            <input type="hidden" name="id" value="<?= $lead->id?>">
            <input type="hidden" name="_method" value="delete">
            <button type="submit" name="delete" class="btn btn-danger">Delete <?= $lead->company_name; ?></button>
        </div>
    </form>
</div>

<?php else: ?>

<h2>We're sorry, but there was a problem with that last action</h2>

<?php if(!empty($_GLOBALS['messge'])) : ?>

<pre>
<?= $_GLOBALS['message'] ?>
</pre>


<?php 
endif;
endif;

require_once __DIR__.'/../../public/template-parts/footer.php'; ?>