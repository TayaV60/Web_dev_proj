<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

$id=$_GET['id'];

function deleteTemplate($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM Templates WHERE id = ?");

    // Check if prepare() failed.
    if ( false === $stmt ) {
        error_log('mysqli prepare() failed: ');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
        return 0;
    }

    // Bind the value to the statement
    $bind = $stmt->bind_param('i', $id);
    
    // Check if bind_param() failed.
    if ( false === $bind ) {
        error_log('bind_param() failed:');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
        return 0;
    }

    $exec = $stmt->execute();
    // Check if execute() failed. 
    if ( false === $exec ) {
        error_log('mysqli execute() failed: ');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
        return 0;
    }

    return $stmt->affected_rows;
}

$message_to_user = "Nothing deleted";

$number_of_rows_deleted = deleteTemplate($conn, $id);
if ($number_of_rows_deleted == 1) {
    $message_to_user = "Template deleted successfully";
} elseif ($number_of_rows_deleted > 1) {
    $message_to_user = "More than one template was deleted!";
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
  <!-- the message to user -->
  <?php echo $message_to_user ?>
</div>

</body>