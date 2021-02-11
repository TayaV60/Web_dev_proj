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

    <!-- the contents field -->
    <div class="main">
        <h4>List of applicants</h4>
        <table>
            <tr>
                <td>John White</td>
            </tr>    
            <tr>
                <td>Kate Smith</td>
            </tr>
            <tr>
                <td>James Watson</td>
            </tr>
            <tr>
                <td>Elaine Day</td>
            </tr>

    </div>
</div>            

</body>