<?php
include 'db/Applicants.php';
include 'page_elements/Page.php';

$page = new Page("Edit aoolicant", "Applicants");
print $page->top();

$dbApplicants = new DBApplicants();

// print_r($_POST); // just for debugging purposes

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $id = $_GET['id'];
  if (empty($name) || empty($email) || empty($phone)) {
    $message_to_user = "Name or email or phone is empty";
  } else {
    try {
      $dbApplicants->editApplicant($id, $name, $email, $phone);
      $message_to_user = "User '$name' updated successfully. The email is $email and their phone number is $phone.";
    } catch (Exception $e) {
      $message_to_user = "Could not edit applicant.";
    }
  }
}

?>
<h3>Applicent submitted</h3>
<?php
// the message to user
echo $message_to_user;
print $page->bottom();
