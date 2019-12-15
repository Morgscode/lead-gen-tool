<?php
/**
 * form used to add leads
 * 
 * on post calls function of $lead_cotroller->createLead($newLead)
 * 
 */

?>

<section class="m-4 p-4 text-light">
    <div class="row align-items-center pt-4 pb-4 border-bottom">
        <div class="col-md-6 col-sm-12">
            <h1 class="text-dark">Fill out the form. Simples</h1>
        </div>
        <div class="col-md-6 col-sm-12">
            <form method="post" action="<?php echo $_SERVER['HTTP_REFERER'];?>lead-created" id="addLead"
                class="p-4 bg-dark" class="add-lead-form">
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
        </div>
    </div>
</section>