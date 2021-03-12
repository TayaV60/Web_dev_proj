<?php
include 'coordination/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Edit applicant", "Applicants");
print $page->top();

$coApplicants = new ApplicantsCoordinator();

// print_r($_POST); // just for debugging purposes

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $roles = $_POST['roles'];
  $id = $_GET['id'];
  if (empty($name) || empty($email) || empty($phone)) {
    $message_to_user = "Name or email or phone is empty";
  } else {
    $message_to_user = $coApplicants->updateApplicant($id, $name, $email, $phone, $roles);
  }
}

?>
<h3>Applicent submitted</h3>
<?php
// the message to user
echo $message_to_user;
print $page->bottom();
