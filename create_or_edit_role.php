<?php

require_once 'coordination/Roles.php';
require_once 'page_elements/Page.php';

$handler = new RoleFormHandler();
$data = $handler->handleCreateOrEdit();

$page = new Page($handler->pageTitle, "Roles");
print $page->top();

?>

<?php if ($data->saved): ?>
    Role '<?=$data->title?>' saved successfully.

    <h3>Title</h3>
    <div><?=$data->title?></div>

<?php elseif ($data->errorSaving): ?>

    <?=$data->errorSaving?>

<?php else: ?>

    <div class="role_form_container">
        <div class="role_form">

            <?php if ($hanlder->mode == 'create'): ?>
                <h3>Create a new role</h3>
            <?php else: ?>
                <h3>Edit existing applicant</h3>
            <?php endif?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">

                <label for="title">Role title</label>
                <br>
                <input
                    type="text"
                    name="title"
                    placeholder="Enter the title of new role"
                    value="<?=$data->title?>"
                >

                <?=$data->titleValidationError?>

                <br>
                <br>
                <?php if ($data->valid): ?>
                    <input type="submit" name="save" value="Save">
                <?php else: ?>
                    <input type="submit" name="check" value="Check">
                <?php endif?>

            </form>
        </div>
    </div>
<?php endif?>

<?php

print $page->bottom();?>

