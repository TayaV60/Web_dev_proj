<?php
include 'db/Roles.php';
include 'page_elements/Page.php';

$page = new Page("Edit role", "Roles");
print $page->top();

$dbRoles = new DBRoles();

// print_r($_POST); // just for debugging purposes

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $title = $_POST['title'];
  $id = $_GET['id'];
  if (empty($title)) {
    $message_to_user = "Role is empty";
  } else {
    try {
      $dbRoles->editRole($id, $title);
      $message_to_user = "Role '$title' updated successfully.";
    } catch (Exception $e) {
      $message_to_user = "Could not edit role.";
    }
  }
}

?>
<h3>Role submitted</h3>
<?php
// the message to user
echo $message_to_user;
print $page->bottom();
