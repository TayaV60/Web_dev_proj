<?php
require_once 'page_elements/Page.php';
require_once 'coordination/Feedback.php';
require_once 'coordination/Supporting_functions.php';

function applicantSelectedIfIdsMatch($id1, $id2)
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

$handler = new FeedbackFormHandler();
$data = $handler->handleGenerateFeedback();

$page = new Page("Generate Feedback", "Generate feedback");
print $page->top();

?>
    <h3 class="feedback" >Select the applicant, role and template to start generating feedback.</h4>

    <div class="form_form_container">
    <div class="form_form">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">
            <?php if ($data->applicant): ?>
                <h4 class="feedback" >Selected applicant: <?=$data->applicant["name"]?></h4>
                <input type="hidden" name="applicantId" value="<?=$data->applicant["id"]?>">
            <?php else: ?>
            <select name="applicantId" onchange="if (this.selectedIndex) this.form.submit()" >
                <option value='-1'>Select applicant</option>
                <?php foreach ($data->applicants as $applicant): ?>
                    <option value='<?=$applicant["id"]?>' <?=applicantSelectedIfIdsMatch($applicant["id"], $data->applicantId)?> >
                        <?=$applicant["name"]?>
                    </option>
                <?php endforeach?>
            </select>
            <?php endif?>

            <?php if ($data->applicantRoles): ?>
                <?php if ($data->role): ?>
                    <h4 class="feedback" >Selected role: <?=$data->role["title"]?></h4>
                    <input type="hidden" name="roleId" value="<?=$data->role["id"]?>">
                <?php else: ?>
                    <select name="roleId" onchange="if (this.selectedIndex) this.form.submit()">
                        <option value='-1'>Select role</option>
                        <?php foreach ($data->applicantRoles as $roleId): ?>
                            <option value=<?=$roleId?> >
                                <?=getRoleTitleFromId($roleId, $data->allRoles)?>
                            </option>
                        <?php endforeach?>
                    </select>
                <?php endif?>
            <?php endif?>
            <?php if ($data->role && $data->applicant): ?>
                <?php if ($data->template): ?>
                    <h4 class="feedback" >Selected template: <?=$data->template["title"]?></h4>
                    <input type="hidden" name="templateId" value="<?=$data->template["id"]?>">
                <?php else: ?>
                    <select name="templateId" onchange="if (this.selectedIndex) this.form.submit()">
                        <option value='-1'>Select template</option>
                        <?php foreach ($data->allTemplates as $template): ?>
                            <option value=<?=$template["id"]?> >
                                <?=$template["title"]?>
                            </option>
                        <?php endforeach?>
                    </select>
                <?php endif?>
            <?php endif?>
            <?php if ($data->contents): ?>
                <?php if ($data->preview): ?>
                    <h5>Feedback Preview</h5>
                    <pre class="feedback">
                        <?=$data->contents?>
                    </pre>
                    <h5>Comments Summary</h5>
                    <ul class="feedback-comments" >
                        <?php foreach ($data->selectedComments as $selectedCommentKey): ?>
                            <li>
                                <?=$data->comments[$selectedCommentKey]?>
                            </li>
                        <?php endforeach?>
                    </ul>
                    <!-- the save button has been disabled as saving has not been implmented -->
                    <input type="submit" name="save" value="Save" disabled>
                <?php else: ?>
                    <textarea rows="10" cols="90" name="contents">
                        <?=$data->contents?>
                    </textarea>
                    <h5>Comments</h5>
                    <?php foreach ($data->comments as $key => $comment): ?>
                        <div>
                            <input
                                type="checkbox"
                                value="<?=$key?>"
                                id="selectedComments<?=$key?>"
                                name="selectedComments[]"
                                <?=commentChecked($key, $data->selectedComments)?>
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
