<?php
include 'db/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Edit applicant", "Applicant");
print $page->top();

$dbApplicants = new DBApplicants();

$id=$_GET['id'];

$applicant = $dbApplicants->getApplicants($id);
$name = $applicant["name"];
$email = $applicant["email"];
$phone = $applicant["phone"];

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

            <input
                type="text"
                name="position"
                value=""
                
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
            
            <br>
            <input type="submit" name="newapplicant" value="Save">
            <a href="applicants.php">Cancel</a>
        </form>
    </div>
</div>

<?php

include 'page_elements/Comments.php';

print $page->bottom();
