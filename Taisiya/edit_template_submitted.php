<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

//to avoid sql injections
function editTemplate($conn, $id, $title, $contents, $comments) {
  $stmt = $conn->prepare('UPDATE Templates SET title = ?, contents = ?, comments = ? WHERE id = ?'); 
  $commentsJoined = implode("::::", $comments);
  $stmt->bind_param("sssi", $title, $contents, $commentsJoined, $id);
  
  $stmt->execute();

  //print_r($stmt); just for debugging purposes

  $stmt->close();
}


// print_r($_POST); // just for debugging purposes

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $contents = $_POST['contents'];
  $title = $_POST['title'];
  $comments = $_POST['comments'];
  $id = $_GET['id'];

  if (empty($contents) && empty($title) && empty($comments)) {
    $message_to_user = "Contents of title or contents or comments are empty";
  } else {
    try {
      editTemplate($conn, $id, $title, $contents, $comments);
      $message_to_user = "Template '$title' updated successfully.<h3>Contents</h3><pre>$contents</pre>";
      $message_to_user .= "<h3>Available comments</h3>";
      foreach ($comments as $value) {
        $message_to_user .= "<br><input type='checkbox' disabled checked> $value</li>";
      }
    } catch (Exception $e) {
      $message_to_user = "Could not create template.";
    }
  }
}

// close connection
CloseCon($conn);

?>
<head>
    <link rel="stylesheet" href="forms.css">
</head>    

<body>

<!-- header -->
<div class="header">
    <h1>Happy Tech</h1>
    <h3>HR tool for writing application feedback</h3>
</div>

<!-- horizontal buttons, see code in topmenu.php -->
<?php
include 'topmenu.php';
?>

<!-- container with the vertical buttons and the contents field inside -->
<div class="container">

    <!-- vertical buttons, see code in sidemenu.php -->
    <?php
    include 'sidemenu.php';
    ?>

<div class="main">
  <h3>Template submitted</h3>
  <!-- the message to user -->
  <?php echo $message_to_user ?>
</div>

</body>