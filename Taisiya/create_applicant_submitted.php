<?php

include 'coordination/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Add a new applicant", "Applicants");
print $page->top();

$coApplicants = new ApplicantsCoordinator();

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $roles = $_POST['roles'];

  if (empty($name) || empty($email) || empty($phone) || empty($roles)) {
    $message_to_user = "Name or email or phone or roles is empty";
  } else {
    $message_to_user = $coApplicants->createApplicant($name, $email, $phone, $roles);
  }
}

?>
<h3>Applicant submitted</h3>
<?php 
// the message to user
echo $message_to_user;

print $page->bottom();