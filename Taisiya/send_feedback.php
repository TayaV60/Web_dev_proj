<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

// run queries here...

// close connection
CloseCon($conn);

?>
<head>
    <link rel="stylesheet" href="forms.css">
</head>    

<body>

<div class="header">
    <h1>Happy Tech</h1>
    <h3>HR tool for writing application feedback</h3>
</div>

<!-- horizontal buttons, see code in topmenu.php -->
<?php
include 'topmenu.php';
?>

<div class="container">
    <!-- vertical buttons, see code in sidemenu.php -->
    <?php
    include 'sidemenu.php';
    ?>

    <div class="main">
        <h4>Send feedback</h4>
    </div>
</div>            

</body>