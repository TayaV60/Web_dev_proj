<?php
include 'page_elements/Page.php';
include 'coordination/Applicants.php';

$coApplicants = new ApplicantsCoordinator();
$allRoles = $coApplicants->listRoles();

function getMode($id)
{
    $mode = 'create';
    if ($id != null) {
        $mode = 'edit';
    }
    return $mode;
}

function emailValidation($email)
{
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        return false;
    }
    return true;
}

function phoneValidation($phone)
{
    if (!preg_match('/^((\+44(\s\(0\)\s|\s0\s|\s)?)|0)7\d{3}(\s)?\d{6}$/', $phone)) {
        return false;
    }
    return true;
}

function selected($id, $applicantRoles)
{
    $selected = "";
    if (in_array($id, $applicantRoles)) {
        $selected = "SELECTED";
    }
    return $selected;
}

// GET variables
$id = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$mode = getMode($id);

// POST input field variables
$name = null;
$email = null;
$phone = null;
$applicantRoles = [];

// form state variables
$valid = false;
$saved = false;
$errorSaving = null;
$nameValidationError = null;
$emailValidationError = null;
$phoneValidationError = null;
$rolesValidationError = null;

// if user has not posted yet, setup necessary default values
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($mode == 'edit') {
        // if editing, get the existing template from the DB
        $applicant = $coApplicants->getApplicant($id);
        $name = $applicant["name"];
        $email = $applicant["email"];
        $phone = $applicant["phone"];
        $applicantRoles = $coApplicants->getRolesForApplicant($id);

    }

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (isset($_POST['applicantRoles'])) {
        $applicantRoles = $_POST['applicantRoles'];
    }

    if (strlen($name) < 2) {
        $nameValidationError = "Name is too short";
    }

    if (emailValidation($email) == false) {
        $emailValidationError = "The email format is incorrect";
    }

    if (phoneValidation($phone) == false) {
        $phoneValidationError = "The phone format is incorrect";
    }

    if (!$applicantRoles || count($applicantRoles) < 1) {
        $rolesValidationError = "Please select a role";
    }

    if (!$nameValidationError && !$emailValidationError && !$phoneValidationError && !$rolesValidationError) {
        $valid = true;
    }

    if ($valid && isset($_POST['save'])) {
        try {
            if ($id && $mode == 'edit') {
                // if there is an id and mode is edit, then try to save using the editTemplate method
                $coApplicants->editApplicant($id, $name, $email, $phone, $applicantRoles);
            } else {
                // if not, try to create
                $coApplicants->createApplicant($name, $email, $phone, $applicantRoles);
            }
            $saved = true;
        } catch (Exception $e) {
            $errorSaving = "Could not create applicant.";
        }
    }
}

$pageTitle = 'Create a new applicant';
if ($mode == 'edit') {
    $pageTitle = 'Edit an applicant';
}

$page = new Page($pageTitle, "Applicants");
print $page->top();

?>

<?php if ($saved): ?>
    Applicant '<?=$name?>' saved successfully.

    <h3>Email</h3>
    <div><?=$email?></div>

    <h3>Phone</h3>
    <div><?=$phone?></div>

    <h3>Roles</h3>
    <ul>
        <?php foreach ($applicantRoles as $roleId): ?>
            <li><?=getRoleTitleFromId($roleId, $allRoles)?></li>
        <?php endforeach?>
    </ul>
<?php elseif ($errorSaving): ?>

    <?=$errorSaving?>

<?php else: ?>

<div class="applicant_form_container">
    <div class="applicant_form">

        <?php if ($mode == 'create'): ?>
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
                value="<?=$name?>"
            >
            <?=$nameValidationError?>
            <br>
            <br>
            <label for="email">Applicant's email address</label>
            <br>
            <input
                type="text"
                name="email"
                placeholder="Enter the applicant's email"
                value="<?=$email?>"
            >
            <?=$emailValidationError?>

            <br>
            <br>
            <label for="phone">Applicant's phone number</label>
            <br>
            <input
                type="text"
                name="phone"
                placeholder="Enter the applicant's phone number"
                value="<?=$phone?>"
            >
            <?=$phoneValidationError?>
            <br>
            <br>
            <label for="roles">Roles applied for</label>
            <br>
            <select name="applicantRoles[]" multiple>
                <?php foreach ($allRoles as $role): ?>
                    <option value='<?=$role["id"]?>' <?=selected($role["id"], $applicantRoles)?> >
                        <?=$role["title"]?>
                    </option>
                <?php endforeach?>
            </select>
            <?=$rolesValidationError?>

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