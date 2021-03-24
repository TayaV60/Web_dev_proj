<?php
require_once 'coordination/Feedback.php';
require_once 'page_elements/Page.php';

$page = new Page("Delete template", "Templates");
print $page->top();

// a FeedbackCoordinator object
$coFeedback = new FeedbackCoordinator();

// GET parameters
$id = $_GET['id'];
$confirmed = $_GET['confirmed'];

// Deletion status
$deleted = false;
$deletionError = null;

// The template to be deleted
$template = $coFeedback->getTemplate($id);
$contents = $template["contents"];
$title = $template["title"];
$comments = $template["comments"];

if ($confirmed) { // if the user has confirmed, then try to delete
    try {
        $result = $coFeedback->deleteTemplate($id);
        $affectedRows = $result->getAffectedRows();
        if ($affectedRows == 1) {
            $deleted = true;
        } else if ($affectedRows == 0) {
            throw new Exception("No rows deleted");
        } else {
            throw new Exception("Too many rows deleted ($affectedRows)");
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $deletionError = "Could not delete. $message";
    }
}

?>
<div class="template_form_container">

    <?php if ($deleted): ?>

        Template <?=$title?> has been deleted.

    <?php elseif ($deletionError): ?>

        <?=$deletionError?>

    <?php else: ?>

        <div class="template_form">
            <h3>Are you sure you want to delete this template?</h3>
            <h4>Template name</h4>
            <?=$title?>"
            <h4>Template contents</h4>
            <pre><?=$contents?></pre>
            <h4>Template Comments</h4>
            <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <input type='checkbox' disabled checked><?=$comment?>
                </li>
            <?php endforeach?>
            </ul>
            <a href="templates.php">Cancel</a>
            <a href="delete_template.php?id=<?=$id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php

print $page->bottom();
