<?php
require_once 'coordination/Applicants.php';
require_once 'page_elements/Page.php';

$page = new Page("Delete applicant", "Applicants");
print $page->top();

$coApplicants = new ApplicantsCoordinator();

$id = $_GET['id'];
$confirmed = $_GET['confirmed'];

$deleted = false;
$deletionError = null;

$applicant = $coApplicants->getApplicant($id);
$name = $applicant["name"];
$email = $applicant["email"];
$phone = $applicant["phone"];

$applicantRoles = $coApplicants->getRolesForApplicant($id);
$roles = $coApplicants->listRoles();

$applicantRoleTitles = [];
foreach ($roles as $role) {
    $roleId = $role["id"];
    if (in_array($roleId, $applicantRoles)) {
        $applicantRoleTitles[] = $role["title"];
    }
}

if ($confirmed) {
    try {
        $result = $coApplicants->removeApplicant($id);
        $affectedRows = $result->getAffectedRows();
        $deleted = true;
        if ($affectedRows != 1) {
            throw new Exception("Wrong number of rows deleted ($affectedRows)");
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $deletionError = "Could not delete $message";
    }
}

?>
<div class="applicant_form_container">

    <?php if ($deleted): ?>

        Applicant <?=$name?> has been deleted.

    <?php elseif ($deletionError): ?>

        <?=$deletionError?>

    <?php else: ?>

        <div class="applicant_form">
            <h3>Are you sure you want to delete this applicant?</h3>
            <h4>Applicant name</h4>
            <?=$name?>
            <h4>Email address</h4>
            <?=$email?>
            <h4>Phone number</h4>
            <?=$phone?>
            <h4>Roles applied for</h4>
            <?=$role["title"]?>

            <br>
            <a href="applicants.php">Cancel</a>
            <a href="delete_applicant.php?id=<?=$id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php

print $page->bottom();
