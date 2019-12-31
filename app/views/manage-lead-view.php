<?php require_once __DIR__.'/../controller/LeadController.php';

require_once __DIR__.'/../../public/template-parts/header.php'; ?>

<?php require_once __DIR__.'/../../public/template-parts/lead-single.php'; ?>

<div class="company-actions">
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link active" id="notes">Notes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="meetings">Meetings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="events">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="proposals">Proposals</a>
        </li>
    </ul>
</div>

<section id="notes-panel" class="pb-4">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review notes on <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-notes">See all notes</button>
            <button class="btn btn-success ml-4" type="button" id="show-note-form">Add note</button>
        </div>
        <form class="card mb-4 p-4 bg-dark text-light d-none" id="note-form" method="post">
            <div class="row mr-0 ml-0">
                <h4>Add a note for <?= $lead->company_name; ?></h4>
                <button class="ml-auto btn p-1" type="button" id="close-note-form">Close form</button>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="hidden" name="add-note">
                <input class="form-control" type="text" name="title" required="required"
                    placeholder="Add note title...">
            </div>
            <div class="form-group">
                <label for="note">Note:</label>
                <textarea name="note" id="#new-note" class="form-control" rows="10"
                    placeholder="Add your note here..."></textarea>
            </div>
            <div class="form-group row ml-0 mr-0">
                <button type="button" id="clear-note-form" class="btn btn-secondary">Clear note</button>
                <button type="button" id="save=note" class="btn btn-success ml-auto"
                    data-company-id="<?= $lead->id;?>">Save
                    note</button>
            </div>
        </form>
    </div>
</section>

<section id="meetings-panel" class="d-none">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review scheduled meetings with <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-meetings">See all meetings</button>
            <button class="btn btn-success ml-auto" type="button" id="add-meeting">Schedule meeting</button>
        </div>
    </div>
</section>

<section id="events-panel" class="d-none">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review planned events for <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-events">See all events</button>
            <button class="btn btn-success ml-auto" type="button" id="add-event">Add event</button>
        </div>
    </div>
</section>

<section id="proposals-panel" class="d-none">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review proposals made to <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-notes">See all proposals</button>
            <button class="btn btn-success ml-auto" type="button" id="add-notes">Add proposal</button>
        </div>
    </div>
</section>

<?php require_once __DIR__.'/../../public/template-parts/footer.php';  ?>