<?php
include 'db/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Delete applicant", "Applicants");
print $page->top();

$dbApplicants = new DBApplicants();

$id=$_GET['id'];

$applicant = $dbApplicants->getApplicants($id);
$name = $applicant["name"];
$position = $applicant["position"];
$email = $applicant["email"];
$phone = $applicant["phone"];

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
                value="<?php echo $position ?>"
                
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
        <a href="delete_applicant_submitted.php?id=<?php echo $id?>">Delete</a>
        
    </div>
</div>
<?php

print $page->bottom();
