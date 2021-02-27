<?php
include 'db/Templates.php';
include 'page_elements/Page.php';

$page = new Page("Delete template", "Templates");
print $page->top();

$dbTemplates = new DBTemplates();

$id=$_GET['id'];

$message_to_user = "Nothing deleted";

$number_of_rows_deleted = $dbTemplates->deleteTemplate($id);
if ($number_of_rows_deleted == 1) {
    $message_to_user = "Template deleted successfully";
} elseif ($number_of_rows_deleted > 1) {
    $message_to_user = "More than one template was deleted!";
}

// the message to user
echo $message_to_user;
print $page->bottom();
