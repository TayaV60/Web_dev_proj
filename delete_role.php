<?php

require_once 'coordination/Roles.php';
require_once 'page_elements/Page.php';

$page = new Page("Delete role", "Roles");
print $page->top();

$handler = new RoleFormHandler();
$data = $handler->handleDelete();

?>
<div class="role_form_container">

    <?php if ($data->deleted): ?>

        Role <?=$data->title?> has been deleted.

    <?php elseif ($data->deletionError): ?>

        <?=$data->deletionError?>

    <?php else: ?>

        <div class="role_form">
            <h3>Are you sure you want to delete this role?</h3>
            <h4>Role title</h4>
            <?=$data->title?>
            <br>
            <br>
            <a href="roles.php">Cancel</a>
            <a href="delete_role.php?id=<?=$data->id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php

print $page->bottom();
