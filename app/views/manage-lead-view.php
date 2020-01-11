<?php require_once __DIR__.'/../controllers/LeadController.php';

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
    </ul>
</div>

<section id="notes-panel" class="pb-4">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review notes on <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-notes">See all notes</button>
            <button class="btn btn-success ml-4" type="button" id="show-note-form">Add note</button>
        </div>
        <form class="card mb-4 p-4 bg-dark text-light d-none" id="note-form" method="post"
            data-company-id="<?= $lead->id; ?>">
            <div class="row mr-0 ml-0">
                <h4>Add a note for <?= $lead->company_name; ?></h4>
                <button class="ml-auto btn p-1" type="button" id="close-note-form">Close form</button>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input class="form-control" type="text" name="note-title" id="note-title" required="required"
                    placeholder="Add note title...">
            </div>
            <div class="form-group">
                <label for="note">Note:</label>
                <textarea name="note" id="note" class="form-control" rows="10"
                    placeholder="Add your note here..."></textarea>
            </div>
            <div class="form-group row ml-0 mr-0">
                <button type="button" id="clear-note-form" class="btn btn-secondary">Clear note</button>
                <button type="button" id="save-note" class="btn btn-success ml-auto"
                    data-company-id="<?= $lead->id;?>">Save
                    note</button>
            </div>
        </form>
    </div>
</section>

<section id="meetings-panel" class="d-none pb-4">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review scheduled meetings with <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-meetings">See all meetings</button>
            <button class="btn btn-success ml-4" type="button" id="show-meeting-form">Schedule meeting</button>
        </div>
        <form class="card mb-4 p-4 bg-dark text-light d-none" id="meeting-form" method="post">
            <div class="row mr-0 ml-0">
                <h4>Schedule a meeting with <?= $lead->company_name; ?></h4>
                <button class="ml-auto btn p-1" type="button" id="close-meeting-form">Close form</button>
            </div>

            <div class="form-group">
                <label for="title">Meeting name:</label>
                <input class="form-control" type="text" name="meeting-name" required="required"
                    placeholder="Enter name of the meeting...">
            </div>
            <div class="form-group">
                <label for="address">Meeting address:</label>
                <input class="form-control" type="text" name="meeting-address" required="required"
                    placeholder="Enter meeting address...">
            </div>
            <div class="form-group">
                <label for="address">Meeting date:</label>
                <input class="form-control" type="text" name="meeting-date" required="required"
                    placeholder="Enter the date of the meeting...">
            </div>
            <div class="form-group">
                <label for="address">Meeting time:</label>
                <input class="form-control" type="text" name="meeting-time" required="required"
                    placeholder="Add time the meeting begins...">
            </div>
            <div class="form-group">
                <label for="note">Note:</label>
                <textarea name="meeting-note" id="meeting-note" class="form-control" rows="10"
                    placeholder="Add your note here..."></textarea>
            </div>
            <div class="form-group row ml-0 mr-0">
                <button type="button" id="clear-meeting-form" class="btn btn-secondary">Clear meeting</button>
                <button type="button" id="save-meeting" class="btn btn-success ml-auto"
                    data-company-id="<?= $lead->id;?>">Save
                    meeting</button>
            </div>
        </form>
    </div>
</section>

<section id="events-panel" class="d-none pb-4">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review planned events for <?= $lead->company_name ?> here</h3>
        <div class="row ml-0 mr-0 pb-4 pt-4">
            <button class="btn btn-primary" type="button" id="see-events">See all events</button>
            <button class="btn btn-success ml-4" type="button" id="show-event-form">Add event</button>
        </div>
        <form class="card mb-4 p-4 bg-dark text-light d-none" id="event-form" method="post">
            <div class="row mr-0 ml-0">
                <h4>Add a event for <?= $lead->company_name; ?></h4>
                <button class="ml-auto btn p-1" type="button" id="close-event-form">Close form</button>
            </div>

            <div class="form-group">
                <label for="title">Event name:</label>
                <input class="form-control" type="text" name="event-name" required="required"
                    placeholder="Add name of the event...">
            </div>
            <div class="form-group">
                <label for="address">Event address:</label>
                <input class="form-control" type="text" name="event-address" required="required"
                    placeholder="Add event address...">
            </div>
            <div class="form-group">
                <label for="address">Event date:</label>
                <input class="form-control" type="text" name="event-date" required="required"
                    placeholder="Add time the date of the event...">
            </div>
            <div class="form-group">
                <label for="address">Event time:</label>
                <input class="form-control" type="text" name="event-time" required="required"
                    placeholder="Add time the event begins...">
            </div>
            <div class="form-group">
                <label for="note">Note:</label>
                <textarea name="event-note" id="event-note" class="form-control" rows="10"
                    placeholder="Add your note here..."></textarea>
            </div>
            <div class="form-group row ml-0 mr-0">
                <button type="button" id="clear-event-form" class="btn btn-secondary">Clear event</button>
                <button type="button" id="save-event" class="btn btn-success ml-auto"
                    data-company-id="<?= $lead->id;?>">Save
                    event</button>
            </div>
        </form>
    </div>
</section>


<?php require_once __DIR__.'/../../public/template-parts/footer.php';  ?>