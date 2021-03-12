<?php
include 'coordination/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Delete applicant", "Applicants");
print $page->top();

$coApplicants = new ApplicantsCoordinator();

$id=$_GET['id'];

$message_to_user = $coApplicants->removeApplicant($id);

// the message to user
echo $message_to_user;
print $page->bottom();
