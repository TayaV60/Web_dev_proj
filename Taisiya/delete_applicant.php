<?php
include 'coordination/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Delete applicant", "Applicants");
print $page->top();

$coApplicants = new ApplicantsCoordinator();

$id = $_GET['id'];

$applicant = $coApplicants->getApplicant($id);
$name = $applicant["name"];
$email = $applicant["email"];
$phone = $applicant["phone"];

$applicantRoles = $coApplicants->getRolesForApplicant($id);
$roles = $coApplicants->listRoles();

$applicantRoleTitles = [];
foreach ($roles as $role) {
    $id = $role["id"];
    if (in_array($id, $applicantRoles)) {
        $applicantRoleTitles[] = $role["title"];
    }
}

?>
<div class="applicant_form_container">
    <div class="applicant_form">
        <h3>Are you sure you want to delete this applicant?</h3>
        <form>
            <label for="name">Applicant name</label>
            <br>
            <input
                type="text"
                name="name"
                value="<?php echo $name ?>"

            >

            <input
                type="text"
                name="position"
                value="<?php echo implode(",", $applicantRoleTitles) ?>"

            >

            <input
                type="text"
                name="email"
                value="<?php echo $email ?>"

            >

            <input
                type="text"
                name="phone"
                value="<?php echo $phone ?>"

            >

            </div>
            <br>
        </form>
        <a href="applicants.php">Cancel</a>
        <a href="delete_applicant_submitted.php?id=<?php echo $id ?>">Delete</a>

    </div>
</div>
<?php

print $page->bottom();
