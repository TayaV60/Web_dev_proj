<?php

require_once 'coordination/Applicants.php';
require_once 'coordination/Supporting_functions.php';
require_once 'page_elements/Page.php';

$handler = new ApplicantFormHandler();
$data = $handler->handleCreateOrEdit();

$page = new Page($data->pageTitle, "Applicants");
print $page->top();

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

print $page->bottom();?>