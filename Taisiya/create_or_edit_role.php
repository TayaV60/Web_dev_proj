<?php
include 'page_elements/Page.php';
include 'db/Roles.php';

$dbRoles = new DBRoles();

function getMode($id)
{
    $mode = 'create';
    if ($id != null) {
        $mode = 'edit';
    }
    return $mode;
}

// GET variables
$id = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$mode = getMode($id);

// POST input field variables
$title = null;

// form state variables
$valid = false;
$saved = false;
$errorSaving = null;
$titleValidationError = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($mode == 'edit') {
        $role = $dbRoles->getRole($id);
        $title = $role["title"];
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
}

if (strlen($title) < 4) {
    $titleValidationError = "Name is too short";
}

if (!$titleValidationError) {
    $valid = true;
}

if ($valid && isset($_POST['save'])) {
    try {
        if ($id && $mode == 'edit') {

            $dbRoles->editRole($id, $title);
        } else {
            $dbRoles->createRole($title);
        }
        $saved = true;
    } catch (Exception $e) {
        $errorSaving = "Could not create role.";
    }
}

$pageTitle = 'Create a new role';
if ($mode == 'edit') {
    $pageTitle = 'Edit a role';
}

$page = new Page($pageTitle, "Roles");
print $page->top();

?>

<?php if ($saved): ?>
    Role '<?=$title?>' saved successfully.

    <h3>Title</h3>
    <div><?=$title?></div>

<?php elseif ($errorSaving): ?>

    <?=$errorSaving?>

<?php else: ?>

    <div class="role_form_container">
        <div class="role_form">

            <?php if ($mode == 'create'): ?>
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
                    value="<?=$title?>"
                >

                <?=$titleValidationError?>

                <br>
                <br>
                <?php if ($valid): ?>
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

