<?php
include 'db/Roles.php';
include 'page_elements/Page.php';

$page = new Page("Delete role", "Roles");
print $page->top();

$dbRoles = new DBRoles();

$id=$_GET['id'];

$role = $dbRoles->getRole($id);
$title = $role["title"];

?>
<div class="role_form_container">
    <div class="role_form">
        <h3>Are you sure you want to delete this role?</h3>
        <form>
            <label for="name">Role</label>
            <br>
            <input
                type="text"
                name="title"
                value="<?php echo $title ?>"
                
            >
            
            </div>
            <br>
        </form>
        <a href="roles.php">Cancel</a>
        <a href="delete_role_submitted.php?id=<?php echo $id?>">Delete</a>
        
    </div>
</div>
<?php

print $page->bottom();
