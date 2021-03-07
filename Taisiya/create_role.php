<?php
include 'page_elements/Page.php';

$page = new Page("Create a new role", "Roles");
print $page->top();

?>
<div class="role_form_container">
    <div class="role_form">
        <h3>Create a new role</h3>
        <form action="create_role_submitted.php" method="post">

            <label for="name">Role</label>
            <br>
            <input
                type="text"
                name="title"
                placeholder="Enter the title of new role"
            >

            <br>
            <br>
            <br>
            <input type="submit" name="newrole" value="Save">
            <a href="roles.php">Cancel</a>
            
        </form>
    </div>

</div>


<?php

print $page->bottom();