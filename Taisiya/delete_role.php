<?php
require_once 'db/Roles.php';
require_once 'page_elements/Page.php';

$page = new Page("Delete role", "Roles");
print $page->top();

$dbRoles = new DBRoles();

$id = $_GET['id'];
$confirmed = $_GET['confirmed'];

$deleted = false;
$deletionError = null;

$role = $dbRoles->getRole($id);
$title = $role["title"];

if ($confirmed) {
    try {
        $result = $dbRoles->deleteRole($id);
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
<div class="role_form_container">

    <?php if ($deleted): ?>

        Role <?=$title?> has been deleted.

    <?php elseif ($deletionError): ?>

        <?=$deletionError?>

    <?php else: ?>

        <div class="role_form">
            <h3>Are you sure you want to delete this role?</h3>
            <h4>Role title</h4>
            <?=$title?>
            <br>
            <br>
            <a href="roles.php">Cancel</a>
            <a href="delete_role.php?id=<?=$id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php

print $page->bottom();
