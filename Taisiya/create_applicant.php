<?php
include 'page_elements/Page.php';
include 'db/Roles.php';

$page = new Page("Create a new applicant", "Applicants");
print $page->top();

$dbRoles = new DBRoles();
$roles = $dbRoles->listRoles();

?>
<div class="applicant_form_container">
    <div class="applicant_form">
        <h3>Create a new applicant</h3>
        <form action="create_applicant_submitted.php" method="post">

            <label for="name">Applicant name</label>
            <br>
            <input
                type="text"
                name="name"
                placeholder="Enter the name of new applicant"
            >

            <br>
            <br>
            <label for="position">Position applied for</label>
            <br>
            <?php
                echo "<select name='roles[]' multiple>";
                foreach ($roles as $value) {
                    $id = $value["id"];
                    $title = $value["title"];
                    echo "<option value='$id'>$title</option>";
                }
                echo "</select>";
            ?>

            <br>
            <br>
            <label for="email">Applicant's email address</label>
            <br>
            <input
                type="text"
                name="email"
                placeholder="Enter the applicant's email"
            >

            <br>
            <br>
            <label for="phone">Applicant's phone number</label>
            <br>
            <input
                type="text"
                name="phone"
                placeholder="Enter the applicant's phone number"
            >
            <br>
            <br>
            <br>
            <input type="submit" name="newapplicant" value="Save">
            <a href="applicants.php">Cancel</a>
            
        </form>
    </div>

</div>


<?php

print $page->bottom();