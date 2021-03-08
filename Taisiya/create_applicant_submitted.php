<?php
include 'db/Applicants.php';
include 'db/ApplicantsRoles.php';
include 'page_elements/Page.php';

$page = new Page("Add a new applicant", "Applicants");
print $page->top();

$dbApplicants = new DBApplicants();
$dbApplicantsRoles = new DBApplicantsRoles();

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $roles = $_POST['roles'];
  print_r($roles);
  if (empty($name) || empty($email) || empty($phone) || empty($roles)) {
    $message_to_user = "Name or email or phone or roles is empty";
  } else {
    try {
      $result = $dbApplicants->createApplicant($name, $email, $phone, $roles);
      print_r($result);
      $createdApplicant = $dbApplicants->getApplicantByName($name);
      $applicantId = $createdApplicant['id'];
      foreach ($roles as $roleId) {
        $dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
      }
      $message_to_user = "Applicant '$name' created successfully. The email is $email and their phone number is $phone.";
    } catch (Exception $e) {
      $message = $e->getMessage();
      $message_to_user = "Could not add applicant. $message";
    }
  }
}

?>
<h3>Applicant submitted</h3>
<?php 
// the message to user
echo $message_to_user;

print $page->bottom();