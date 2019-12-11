<?php
/**
 * form used to add leads
 * 
 * on post calls function of $lead_cotroller->createLead($newLead)
 * 
 */

?>

<section>
    <form action="" method="post" id="addLead" class="p-4" class="add-lead-form">
        <div class="form-close"><strong>X</strong></div>
        <div class="form-group">
            <label for="company-name">Company Name:</label>
            <input type="text" class="form-control" placeholder="enter company name" id="company-name">
        </div>
        <div class="form-group">
            <label for="company-name">Company Contact:</label>
            <input type="text" class="form-control" placeholder="enter contact name" id="company-name">
        </div>
        <div class="form-group">
            <label for="company-name">Company Contact Email:</label>
            <input type="text" class="form-control" placeholder="enter contact's email address" id="company-name">
        </div>
        <button type="submit" class="btn btn-success">Submit Lead</button>
    </form>
</section>