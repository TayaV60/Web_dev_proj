<?php

require_once 'coordination/Applicants.php';
require_once 'page_elements/Page.php';

function listView($data)
{
    ?>

<a class='links' href="create_or_edit_applicant.php">Create new applicant</a>
<br>
<br>
<table>
<thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Roles</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->applicants as $value): ?>
            <tr>
                <td>
                    <?=$value["name"]?>
                </td>
                <td>
                    <?=$value["email"]?>
                </td>
                <td>
                    <?=$value["phone"]?>
                </td>
                <td>
                    <?=$value["titles"]?>
                </td>
                <td>
                    <a href="create_or_edit_applicant.php?id=<?=$value["id"]?>" value="Edit <?=$value["name"]?>" >
                        <img class="icon" src="assets/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="delete_applicant.php?id=<?=$value["id"]?>" value="Delete <?=$value["name"]?>" >
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
<div class="applicant_form_container">

    <?php if ($data->deleted): ?>

        Applicant <?=$data->name?> has been deleted.

    <?php elseif ($data->deletionError): ?>

        <?=$data->deletionError?>

    <?php else: ?>

        <div class="applicant_form">
            <h3>Are you sure you want to delete this applicant?</h3>
            <h4>Applicant name</h4>
            <?=$data->name?>
            <h4>Email address</h4>
            <?=$data->email?>
            <h4>Phone number</h4>
            <?=$data->phone?>
            <h4>Roles applied for</h4>
            <?=implode(", ", $data->applicantRoleTitles)?>

            <br>
            <a href="applicants.php">Cancel</a>
            <a href="delete_applicant.php?id=<?=$data->id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php
}

function createOrEditView($data)
{
    ?>

<?php if ($data->saved): ?>
    Applicant '<?=$data->name?>' saved successfully.

    <h3>Email</h3>
    <div><?=$data->email?></div>

    <h3>Phone</h3>
    <div><?=$data->phone?></div>

    <h3>Roles</h3>
    <ul>
        <?php foreach ($data->applicantRoles as $roleId): ?>
            <li><?=getRoleTitleFromId($roleId, $data->allRoles)?></li>
        <?php endforeach?>
    </ul>
<?php elseif ($data->errorSaving): ?>

    <?=$data->errorSaving?>

<?php else: ?>

<div class="applicant_form_container">
    <div class="applicant_form">

        <?php if ($data->mode == 'create'): ?>
            <h3>Create a new applicant</h3>
        <?php else: ?>
            <h3>Edit existing applicant</h3>
        <?php endif?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">


            <label for="name">Applicant name</label>
            <br>
            <input
                type="text"
                name="name"
                placeholder="Enter the name of new applicant"
                value="<?=$data->name?>"
            >
            <?=$data->nameValidationError?>
            <br>
            <br>
            <label for="email">Applicant's email address</label>
            <br>
            <input
                type="text"
                name="email"
                placeholder="Enter the applicant's email"
                value="<?=$data->email?>"
            >
            <?=$data->emailValidationError?>

            <br>
            <br>
            <label for="phone">Applicant's phone number</label>
            <br>
            <input
                type="text"
                name="phone"
                placeholder="Enter the applicant's phone number"
                value="<?=$data->phone?>"
            >
            <?=$data->phoneValidationError?>
            <br>
            <br>
            <label for="roles">Roles applied for</label>
            <br>
            <select name="applicantRoles[]" multiple>
                <?php foreach ($data->allRoles as $role): ?>
                    <option value='<?=$role["id"]?>' <?=applicantSelected($role["id"], $data->applicantRoles)?> >
                        <?=$role["title"]?>
                    </option>
                <?php endforeach?>
            </select>
            <?=$data->rolesValidationError?>

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

class ApplicantView
{
    public function __construct()
    {
        $this->handler = new ApplicantFormHandler();
    }

    function list() {
        $data = $this->handler->handleList();

        $page = new Page("Applicants", "Applicants");
        print $page->top();

        listView($data);

        print $page->bottom();
    }

    public function delete()
    {
        $data = $this->handler->handleDelete();

        $page = new Page("Delete applicant", "Applicants");
        print $page->top();

        deleteView($data);

        print $page->bottom();
    }

    public function createOrEdit()
    {
        $data = $this->handler->handleCreateOrEdit();

        $page = new Page($data->pageTitle, "Applicants");
        print $page->top();

        createOrEditView($data);

        print $page->bottom();
    }
}
