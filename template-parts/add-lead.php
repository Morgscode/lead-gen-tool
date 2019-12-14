<?php
/**
 * form used to add leads
 * 
 * on post calls function of $lead_cotroller->createLead($newLead)
 * 
 */

?>

<?php if ($message) :  ?>

<h2><?= $message; ?></h2>

<?php endif; ?>

<section class="bg-dark mt-4 text-light">
    <form method="post" id="addLead" class="p-4" class="add-lead-form">
        <div class="form-group">
            <label for="company-name">Company Name:</label>
            <input type="text" name="company-name" class="form-control" placeholder="enter company name"
                id="company-name" required="required">
        </div>
        <div class="form-group">
            <label for="contact-name">Company Contact:</label>
            <input type="text" name="contact-name" class="form-control" placeholder="enter contact name"
                id="contact-name" required="required">
        </div>
        <div class="form-group">
            <label for="company-contact-email">Company Contact Email:</label>
            <input type="text" name="company-contact-email" class="form-control"
                placeholder="enter contact's email address" id="company-contact-email" required="required">
        </div>
        <button type="submit" class="btn btn-success">Submit Lead</button>
    </form>
</section>