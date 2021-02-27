<?php
include 'db/Templates.php';

$dbTemplates = new DBTemplates();

$id=$_GET['id'];

$message_to_user = "Nothing deleted";

$number_of_rows_deleted = $dbTemplates->deleteTemplate($id);
if ($number_of_rows_deleted == 1) {
    $message_to_user = "Template deleted successfully";
} elseif ($number_of_rows_deleted > 1) {
    $message_to_user = "More than one template was deleted!";
}

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
topMenu("Templates");
?>

<!-- container with the vertical buttons and the contents field inside -->
<div class="container">

    <!-- vertical buttons, see code in sidemenu.php -->
    <?php
    include 'sidemenu.php';
    sideMenu("");
    ?>

<div class="main">
  <!-- the message to user -->
  <?php echo $message_to_user ?>
</div>

</body>