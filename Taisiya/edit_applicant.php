<?php
include 'coordination/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Edit applicant", "Applicant");
print $page->top();

$coApplicants = new ApplicantsCoordinator();

$id=$_GET['id'];

$applicant = $coApplicants->getApplicant($id);
$name = $applicant["name"];
$email = $applicant["email"];
$phone = $applicant["phone"];

$roles = $coApplicants->listRoles();
$applicantRoles = $coApplicants->getRolesForApplicant($id);

?>
<div class="applicant_form_container">
    <div class="applicant_form">
        <h3>Edit applicant's record</h3>
        <form action="edit_applicant_submitted.php?id=<?php echo $id?>" method="post">
       
            <label for="name">Applicant name</label>
            <br>
            <input
                type="text"
                name="name"
                value="<?php echo $name ?>"
                
            >
            <br>
            <br>

            <?php
                echo "<select name='roles[]' multiple>";
                foreach ($roles as $value) {
                    $id = $value["id"];
                    $title = $value["title"];
                    $selected = "";
                    if (in_array($id, $applicantRoles)) {
                        $selected = "SELECTED";
                    }
                    echo "<option value='$id' $selected>$title</option>";
                }
                echo "</select>";
            ?>
            <br>
            <br>
            <input
                type="text"
                name="email"
                value="<?php echo $email ?>"
                
            >
            <br>
            <br>
            <input
                type="text"
                name="phone"
                value="<?php echo $phone ?>"
                
            >
            
            <br>
            <input type="submit" name="newapplicant" value="Save">
            <a href="applicants.php">Cancel</a>
        </form>
    </div>
</div>

<?php

include 'page_elements/Comments.php';

print $page->bottom();
