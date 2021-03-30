<?php
require_once 'coordination/Applicants.php';
require_once 'page_elements/Page.php';

$page = new Page("Delete applicant", "Applicants");
print $page->top();

$handler = new ApplicantFormHandler();
$data = $handler->handleDelete();

?>
<div class="applicant_form_container">

    <?php if ($data->deleted): ?>

        Applicant <?=$data->name?> has been deleted.

    <?php elseif ($data->deletionError): ?>

        <?=$data->deletionError?>

    <?php else: ?>

        <div class="applicant_form">
            <h3>Are you sure you want to delete this applicant?</h3>
            <h4>Applicant name</h4>
            <?=$data->name?>
            <h4>Email address</h4>
            <?=$data->email?>
            <h4>Phone number</h4>
            <?=$data->phone?>
            <h4>Roles applied for</h4>
            <?=implode(", ", $data->applicantRoleTitles)?>

            <br>
            <a href="applicants.php">Cancel</a>
            <a href="delete_applicant.php?id=<?=$data->id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php

print $page->bottom();
