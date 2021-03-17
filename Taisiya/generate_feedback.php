<?php
include 'page_elements/Page.php';
include 'coordination/Applicants.php';
include 'coordination/Feedback.php';
include 'coordination/Supporting_functions.php';

function applicantSelected($id1, $id2)
{
    if ($id1 == $id2) {
        return "SELECTED";
    }
}

$coApplicants = new ApplicantsCoordinator();
$coFeedback = new FeedbackCoordinator();

//GET variable
$id = getQueryParameter('id');

//POST input field variables
$applicantId = null;
$templateId = null;
$roleId = null;

$applicantRoles = null;

//Form state variables
$selected = false;
$applicantValidationError = null;

$applicant = null;
$role = null;
$template = null;
$contents = "";

$applicants = $coApplicants->listApplicants();
$allRoles = $coApplicants->listRoles();
$allTemplates = $coFeedback->listTemplates();
error_log(print_r($_POST, true));

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicantId = getPostParameter('applicantId');
    if ($applicantId) {
        $applicant = $coApplicants->getApplicant($applicantId);
        $applicantRoles = $coApplicants->getRolesForApplicant($applicantId);
    }
    $roleId = getPostParameter('roleId');
    if ($roleId) {
        $role = $coApplicants->getRole($roleId);
    }
    $templateId = getPostParameter('templateId');
    if ($templateId) {
        $template = $coFeedback->getTemplate($templateId);
        $contents = $template["contents"];
        $contents = str_replace("{{applicant_name}}", $applicant["name"], $contents);
        $contents = str_replace("{{applicant_email}}", $applicant["email"], $contents);
        $date = new DateTime();
        $contents = str_replace("{{date}}", $date->format('d/m/y'), $contents);
        $contents = str_replace("{{position_title}}", $role["title"], $contents);
    }
}

$page = new Page("Generate Feedback", "Generate feedback");
print $page->top();

error_log("template is:");
error_log(print_r($template, true));
error_log("template was");

?>
    <h4>Select the applicant, role and template to start generating feedback.</h4>

    <div class="form_form_container">
    <div class="form_form">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">
            <?php if ($applicant): ?>
                <h4>Selected applicant: <?=$applicant["name"]?></h4>
                <input type="hidden" name="applicantId" value="<?=$applicant["id"]?>">
            <?php else: ?>
            <select name="applicantId" onchange="if (this.selectedIndex) this.form.submit()" >
                <option value='-1'>Select applicant</option>
                <?php foreach ($applicants as $applicant): ?>
                    <option value='<?=$applicant["id"]?>' <?=applicantSelected($applicant["id"], $applicantId)?> >
                        <?=$applicant["name"]?>
                    </option>
                <?php endforeach?>
            </select>
            <?=$applicantValidationError?>
            <?php endif?>
            <br>

            <?php if ($applicantRoles): ?>
                <?php if ($role): ?>
                    <h4>Selected role: <?=$role["title"]?></h4>
                    <input type="hidden" name="roleId" value="<?=$role["id"]?>">
                <?php else: ?>
                    <select name="roleId" onchange="if (this.selectedIndex) this.form.submit()">
                        <option value='-1'>Select role</option>
                        <?php foreach ($applicantRoles as $roleId): ?>
                            <option value=<?=$roleId?> >
                                <?=getRoleTitleFromId($roleId, $allRoles)?>
                            </option>
                        <?php endforeach?>
                    </select>
                <?php endif?>
            <?php endif?>
            <br>
            <?php if ($role && $applicant): ?>
                <?php if ($template): ?>
                    <h4>Selected template: <?=$template["title"]?></h4>
                    <input type="hidden" name="templateId" value="<?=$template["id"]?>">
                <?php else: ?>
                    <select name="templateId" onchange="if (this.selectedIndex) this.form.submit()">
                        <option value='-1'>Select template</option>
                        <?php foreach ($allTemplates as $template): ?>
                            <option value=<?=$template["id"]?> >
                                <?=$template["title"]?>
                            </option>
                        <?php endforeach?>
                    </select>
                <?php endif?>
            <?php endif?>
            <br>
            <?php if ($contents): ?>
                <textarea rows="10" cols="90">
                    <?=$contents?>
                </textarea>
            <?php endif?>

    </form>

    </div>
    </div>

    <?php

print $page->bottom();
