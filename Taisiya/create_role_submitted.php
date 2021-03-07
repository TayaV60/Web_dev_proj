<?php
include 'db/Roles.php';
include 'page_elements/Page.php';

$page = new Page("Add a new role", "Roles");
print $page->top();

$dbRoles = new DBRoles();

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $title = $_POST['title'];
  if (empty($title)) {
    $message_to_user = "The role field is empty";
  } else {
    try {
      $dbRoles->createRole($title);
      $message_to_user = "Role '$title' created successfully.";
    } catch (Exception $e) {
      $message_to_user = "Could not add role.";
    }
  }
}

?>
<h3>Role submitted</h3>
<?php 
// the message to user
echo $message_to_user;

print $page->bottom();