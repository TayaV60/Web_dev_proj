<?php
require_once 'coordination/Templates.php';
require_once 'page_elements/Page.php';

$handler = new TemplateFormHandler();
$data = $handler->handleDelete();

$page = new Page("Delete template", "Templates");
print $page->top();

?>
<div class="template_form_container">

    <?php if ($data->deleted): ?>

        Template <?=$data->title?> has been deleted.

    <?php elseif ($data->deletionError): ?>

        <?=$data->deletionError?>

    <?php else: ?>

        <div class="template_form">
            <h3>Are you sure you want to delete this template?</h3>
            <h4>Template name</h4>
            <?=$data->title?>"
            <h4>Template contents</h4>
            <pre><?=$data->contents?></pre>
            <h4>Template Comments</h4>
            <ul>
            <?php foreach ($data->comments as $comment): ?>
                <li>
                    <input type='checkbox' disabled checked><?=$comment?>
                </li>
            <?php endforeach?>
            </ul>
            <a href="templates.php">Cancel</a>
            <a href="delete_template.php?id=<?=$data->id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php

print $page->bottom();
