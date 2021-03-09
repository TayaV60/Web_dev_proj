<?php
include 'db/Roles.php';
include 'page_elements/Page.php';

$page = new Page("Edit role", "Role");
print $page->top();

$dbRoles = new DBRoles();

$id=$_GET['id'];

$role = $dbRoles->getRole($id);
$title = $role["title"];

?>
<div class="role_form_container">
    <div class="role_form">
        <h3>Edit role</h3>
        <form action="edit_role_submitted.php?id=<?php echo $id?>" method="post">
       
            <label for="title">Role</label>
            <br>
            <input
                type="text"
                name="title"
                value="<?php echo $title ?>"
                
            >
            
            <br>
            <input type="submit" name="newrole" value="Save">
            <a href="roles.php">Cancel</a>
        </form>
    </div>
</div>

<?php

print $page->bottom();
