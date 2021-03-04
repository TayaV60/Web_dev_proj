<?php
include 'db/Templates.php';
include 'page_elements/Page.php';

$page = new Page("Create a new template", "Templates");
print $page->top();

$dbTemplates = new DBTemplates();

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $contents = $_POST['contents'];
  $title = $_POST['title'];
  $comments = $_POST['comments'];
  if (empty($contents) || empty($title) || empty($comments)) {
    $message_to_user = "Contents of title or contents or comments is empty";
  } else {
    try {
      $dbTemplates->createTemplate($title, $contents, $comments);
      $message_to_user = "Template '$title' created successfully.<h3>Contents</h3><pre>$contents</pre>";
      $message_to_user .= "<h3>Available comments</h3>";
      foreach ($comments as $value) {
        $message_to_user .= "<br><input type='checkbox' disabled checked> $value</li>";
      }
    } catch (Exception $e) {
      $message_to_user = "Could not create template.";
    }
  }
}

?>
<h3>Template submitted</h3>
<?php 
// the message to user
echo $message_to_user;

print $page->bottom();
