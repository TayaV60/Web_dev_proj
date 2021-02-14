<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

function createTemplate($conn, $title, $contents) {
  $stmt = $conn->prepare('INSERT INTO Templates (title, contents) VALUES (?, ?)');
  $stmt->bind_param("ss", $title, $contents);
  $stmt->execute();

  // print_r($stmt); just for debugging purposes

  $stmt->close();
}

// print_r($_POST); just for debugging purposes

$message_to_user = "No data posted";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $contents = $_POST['contents'];
  $title = $_POST['title'];
  if (empty($contents) && empty($title)) {
    $message_to_user = "Contents of title or contents are empty";
  } else {
    try {
      createTemplate($conn, $title, $contents);
      $message_to_user = "Template '$title' created successfully.<h3>Contents</h3><pre>$contents</pre>";
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

