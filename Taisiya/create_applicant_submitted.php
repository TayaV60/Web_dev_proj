<?php
include 'db/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Add a new applicant", "Applicants");
print $page->top();

$dbApplicants = new DBApplicants();

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $position = $_POST['position'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  if (empty($name) || empty($position) || empty($email) || empty($phone)) {
    $message_to_user = "Name or position or email or phone is empty";
  } else {
    try {
      $dbApplicants->createApplicant($name, $position, $email, $phone);
      $message_to_user = "Applicant '$name' created successfully, for $position. The email is $email and their phone number is $phone.";
    } catch (Exception $e) {
      $message_to_user = "Could not add applicant.";
    }
  }
}

?>
<h3>Applicant submitted</h3>
<?php 
// the message to user
echo $message_to_user;

print $page->bottom();