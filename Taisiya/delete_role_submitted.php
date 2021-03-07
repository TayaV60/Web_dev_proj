<?php
include 'db/Roles.php';
include 'page_elements/Page.php';

$page = new Page("Delete role", "Roles");
print $page->top();

$dbRoles = new DBRoles();

$id=$_GET['id'];

$message_to_user = "Nothing deleted";

$number_of_rows_deleted = $dbRoles->deleteRole($id);
if ($number_of_rows_deleted == 1) {
    $message_to_user = "Role deleted successfully";
} elseif ($number_of_rows_deleted > 1) {
    $message_to_user = "More than one role was deleted!";
}

// the message to user
echo $message_to_user;
print $page->bottom();
