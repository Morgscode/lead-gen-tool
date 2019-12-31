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

<section id="notes-panel">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review notes on <?= $lead->company_name ?> here</h3>
    </div>
</section>
<section id="meetings-panel" class="d-none">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review scheduled meetings with <?= $lead->company_name ?> here</h3>
    </div>
</section>
<section id="events-panel" class="d-none">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review planned events for <?= $lead->company_name ?> here</h3>
    </div>
</section>
<section id="proposals-panel" class="d-none">
    <div class="card p-4">
        <h3 class="mt-4 mb-4">Create, edit and review proposals made to <?= $lead->company_name ?> here</h3>
    </div>
</section>

<?php require_once __DIR__.'/../../public/template-parts/footer.php';  ?>