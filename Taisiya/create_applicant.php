<?php
include 'page_elements/Page.php';

$page = new Page("Create a new applicant", "Applicants");
print $page->top();

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
            <input
                type="text"
                name="position"
                placeholder="Enter the position applied for"
            >

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