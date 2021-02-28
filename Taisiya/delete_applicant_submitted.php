<?php
include 'db/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Delete applicant", "Applicants");
print $page->top();

$dbApplicants = new DBApplicants();

$id=$_GET['id'];

$message_to_user = "Nothing deleted";

$number_of_rows_deleted = $dbApplicants->deleteApplicant($id);
if ($number_of_rows_deleted == 1) {
    $message_to_user = "Applicant deleted successfully";
} elseif ($number_of_rows_deleted > 1) {
    $message_to_user = "More than one applicant was deleted!";
}

// the message to user
echo $message_to_user;
print $page->bottom();
