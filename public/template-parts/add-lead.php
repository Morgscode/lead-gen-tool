<?php
/**
 * form used to add leads
 * 
 * on post calls function of $lead_cotroller->createLead($newLead)
 * 
 */

?>

<section class="mb-4 pt-4">
    <div class="row align-items-center pt-4 pb-4 border-bottom">
        <div class="col-md-6 col-sm-12 flex-column">
            <p class="mb-4 d-inline-block justify-self-start text-grey">Add a new lead to the database</p>
            <h1 class="text-dark">Fill out the form. Simples</h1>
        </div>
        <div class="col-md-6 col-sm-12">
            <form method="post" id="addLead" class="p-4 bg-dark add-lead-form">
                <div class="form-group">
                    <label class="text-light" for="company-name">Company name:</label>
                    <input type="text" name="company-name" class="form-control" placeholder="enter company name"
                        id="company-name" required="required">
                </div>
                <div class="form-group">
                    <label class="text-light" for="contact-name">Company contact:</label>
                    <input type="text" name="contact-name" class="form-control" placeholder="enter contact name"
                        id="contact-name" required="required">
                </div>
                <div class="form-group">
                    <label class="text-light" for="contact-role">Contact role:</label>
                    <input type="text" name="contact-role" class="form-control" placeholder="enter contact role"
                        id="contact-role" required="required">
                </div>
                <div class="form-group">
                    <label class="text-light" for="company-contact-email">Company contact email:</label>
                    <input type="text" name="company-contact-email" class="form-control"
                        placeholder="enter contact's email address" id="company-contact-email" required="required">
                </div>
                <button type="submit" class="btn btn-success">Submit lead</button>
            </form>
        </div>
    </div>
</section>