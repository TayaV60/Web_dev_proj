<?php

require_once 'coordination/Roles.php';
require_once 'page_elements/Page.php';

function listView($data)
{
    ?>

<a class='links' href="create_or_edit_role.php">Create new role</a>
<br>
<br>
<table>
    <thead>
        <tr>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->roles as $role): ?>
            <tr>
                <td>
                    <?=$role["title"]?>
                </td>
                <td>
                    <a href="create_or_edit_role.php?id=<?=$role["id"]?>" title="Edit <?=$role["title"]?>" >
                        <img class="icon" src="assets/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="delete_role.php?id=<?=$role["id"]?>" title="Delete <?=$role["title"]?>" >
                        <img class="icon" src="assets/delete.png" alt="Delete">
                    </a>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<?php
}

function deleteView($data)
{

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
}

function createOrEditView($data)
{
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

            <?php if ($data->mode == 'create'): ?>
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
}

class RoleView
{
    public function __construct()
    {

        $this->handler = new RoleFormHandler();
    }

    function list() {
        $data = $this->handler->handleList();

        $page = new Page("Roles", "Roles");
        print $page->top();

        listView($data);

        print $page->bottom();
    }

    public function delete()
    {
        $data = $this->handler->handleDelete();

        $page = new Page("Delete role", "Roles");
        print $page->top();

        deleteView($data);

        print $page->bottom();
    }

    public function createOrEdit()
    {
        $data = $this->handler->handleCreateOrEdit();

        $page = new Page($data->pageTitle, "Roles");
        print $page->top();

        createOrEditView($data);

        print $page->bottom();
    }
}
