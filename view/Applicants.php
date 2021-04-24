<?php

require_once 'coordination/Applicants.php';
require_once 'page_elements/Page.php';

// a view class for the applicants pages
class ApplicantView
{
    // constructor instantiates an ApplicantFormHandler
    public function __construct()
    {
        $this->handler = new ApplicantFormHandler();
    }

    // creates the page with a listing of existing applicants after calling the handler's handleList method
    function list() {
        $data = $this->handler->handleList();

        $page = new Page("Applicants", "Applicants");
        print $page->top();

        listView($data);

        print $page->bottom();
    }

    // creates a page for deleting existing applicants after calling the handler's handleDelete method
    public function delete()
    {
        $data = $this->handler->handleDelete();

        $page = new Page("Delete applicant", "Applicants");
        print $page->top();

        deleteView($data);

        print $page->bottom();
    }

    // creates a page for creating or editing an applicant after calling the handler's handleCreateOrEdit method
    public function createOrEdit()
    {
        $data = $this->handler->handleCreateOrEdit();

        $page = new Page($data->pageTitle, "Applicants");
        print $page->top();

        createOrEditView($data);

        print $page->bottom();
    }
}

/* -------------------------------------- SUPPORTING PHP TEMPLATING FUNCTIONS --------------------------------------  */
/* -------------------------------------- (see views/README.md for more info) --------------------------------------  */

// displays the list of existing applicants
function listView($data)
{
    ?>
    <h3><a class='links' href="create_or_edit_applicant.php">Create a new applicant</a></h3>
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

// displays the applicant deletion form
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
            <div class="areyousure" >
                Are you sure you want to delete this applicant?
                <a href="applicants.php">Cancel</a>
                <a href="delete_applicant.php?id=<?=$data->id?>&confirmed=true">Delete</a>
            </div>
            <div class="todelete">
                <h4>Applicant name</h4>
                <?=$data->name?>
                <h4>Email address</h4>
                <?=$data->email?>
                <h4>Phone number</h4>
                <?=$data->phone?>
                <h4>Roles applied for</h4>
                <?=implode(", ", $data->applicantRoleTitles)?>
            </div>
        </div>

    <?php endif?>

</div>
<?php
}

// displays the forn for creating or editing of an applicant
function createOrEditView($data)
{
    ?>
    <?php if ($data->saved): ?>
        <h3>Applicant '<?=$data->name?>' saved successfully.</h3>

        <h4>Email</h4>
        <div><?=$data->email?></div>

        <h4>Phone</h4>
        <div><?=$data->phone?></div>

        <h4>Roles</h4>
        <ul>
            <?php foreach ($data->applicantRoles as $roleId): ?>
                <li><?=getRoleTitleFromId($roleId, $data->allRoles)?></li>
            <?php endforeach?>
        </ul>
    <?php elseif ($data->errorSaving): ?>

        <div class="errorsaving">
            <?=$data->errorSaving?>
        </div>

    <?php else: ?>

    <div class="applicant_form_container">
        <div class="applicant_form">

            <?php if ($data->mode == 'create'): ?>
                <h3>Create a new applicant</h3>
            <?php else: ?>
                <h3>Edit existing applicant</h3>
            <?php endif?>

            <h4><a href="applicants.php">Back to applicant listing</a></h4>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">


                <label for="name">Applicant name</label>
                <br>
                <br>
                <input
                    type="text"
                    name="name"
                    placeholder="Enter the name of new applicant"
                    value="<?=$data->name?>"
                >
                <div class="invalid">
                    <?=$data->nameValidationError?>
                </div>
                <br>
                <br>
                <label for="email">Applicant's email address</label>
                <br>
                <br>
                <input
                    type="text"
                    name="email"
                    placeholder="Enter the applicant's email"
                    value="<?=$data->email?>"
                >
                <div class="invalid">
                    <?=$data->emailValidationError?>
                </div>

                <br>
                <br>
                <label for="phone">Applicant's phone number</label>
                <br>
                <br>
                <input
                    type="text"
                    name="phone"
                    placeholder="Enter the applicant's phone number"
                    value="<?=$data->phone?>"
                >
                <div class="invalid">
                    <?=$data->phoneValidationError?>
                </div>
                <br>
                <br>
                <label for="roles">Roles applied for</label>
                <br>
                <br>
                <select name="applicantRoles[]" multiple>
                    <?php foreach ($data->allRoles as $role): ?>
                        <option value='<?=$role["id"]?>' <?=applicantSelected($role["id"], $data->applicantRoles)?> >
                            <?=$role["title"]?>
                        </option>
                    <?php endforeach?>
                </select>
                <div class="invalid">
                    <?=$data->rolesValidationError?>
                </div>

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
