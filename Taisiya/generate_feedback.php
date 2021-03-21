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

function commentChecked($key, $selectedComments)
{
    foreach ($selectedComments as $selectedCommentKey) {
        if ($selectedCommentKey == $key) {
            return "CHECKED";
        }
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
$selectedComments = [];

// form state variables
$preview = false;

// variables from database
$applicantRoles = null;
$applicant = null;
$role = null;
$template = null;
$contents = "";
$comments = [];
$user = null;

$applicants = $coApplicants->listApplicants();
$allRoles = $coApplicants->listRoles();
$allTemplates = $coFeedback->listTemplates();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $username = $_SERVER['PHP_AUTH_USER'];
        $user = $coFeedback->getUserByUsername($username);
        $contents = $template["contents"];
        $comments = $template["comments"];
        $contents = str_replace("{{applicant_name}}", $applicant["name"], $contents);
        $contents = str_replace("{{applicant_email}}", $applicant["email"], $contents);
        $date = new DateTime();
        $contents = str_replace("{{date}}", $date->format('d/m/y'), $contents);
        $contents = str_replace("{{position_title}}", $role["title"], $contents);
        $contents = str_replace("{{interviewer_name}}", $user["name_surname"], $contents);
        $contents = str_replace("{{interviewer_email}}", $user["username"], $contents);
    }
    if (isset($_POST["selectedComments"])) {
        $selectedComments = $_POST["selectedComments"];
    }
    if (isset($_POST['preview'])) {
        $preview = true;
    }
}

$page = new Page("Generate Feedback", "Generate feedback");
print $page->top();

?>
    <h3 class="feedback" >Select the applicant, role and template to start generating feedback.</h4>

    <div class="form_form_container">
    <div class="form_form">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">
            <?php if ($applicant): ?>
                <h4 class="feedback" >Selected applicant: <?=$applicant["name"]?></h4>
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
            <?php endif?>

            <?php if ($applicantRoles): ?>
                <?php if ($role): ?>
                    <h4 class="feedback" >Selected role: <?=$role["title"]?></h4>
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
            <?php if ($role && $applicant): ?>
                <?php if ($template): ?>
                    <h4 class="feedback" >Selected template: <?=$template["title"]?></h4>
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
            <?php if ($contents): ?>
                <?php if ($preview): ?>
                    <h5>Feedback Preview</h5>
                    <pre class="feedback">
                        <?=$contents?>
                    </pre>
                    <h5>Comments Summary</h5>
                    <ul class="feedback-comments" >
                        <?php foreach ($selectedComments as $selectedCommentKey): ?>
                            <li>
                                <?=$comments[$selectedCommentKey]?>
                            </li>
                        <?php endforeach?>
                    </ul>
                    <input type="submit" name="save" value="Save">
                <?php else: ?>
                    <textarea rows="10" cols="90">
                        <?=$contents?>
                    </textarea>
                    <h5>Comments</h5>
                    <?php foreach ($comments as $key => $comment): ?>
                        <div>
                            <input
                                type="checkbox"
                                value="<?=$key?>"
                                id="selectedComments<?=$key?>"
                                name="selectedComments[]"
                                <?=commentChecked($key, $selectedComments)?>
                            >
                            <label for="selectedComments[]"><?=$comment?></label>
                        </div>
                    <?php endforeach?>
                    <input type="submit" name="preview" value="Preview">
                <?php endif?>
            <?php endif?>

    </form>

    </div>
    </div>

    <?php

print $page->bottom();
