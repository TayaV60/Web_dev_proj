<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

function listTemplates($conn) {
    $result = $conn->query("SELECT id, title FROM Templates");
    $templates = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $templates[] = $row; // append each row to the $templates array
        }
    }
    return $templates;
}

$templates = listTemplates($conn); 

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

    <a href="create_template.php">Create new template</a>

        <br>
        <br>
        <table>
            <?php 
                foreach ($templates as &$value) {
                    $id = $value["id"];
                    $title = $value["title"];
                    $editUrl = "edit_template.php?id=$id";
                    $deleteUrl = "delete_template.php?id=$id";
                    echo "<tr>";
                    echo "<td>";
                    echo $title;
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=\"$editUrl\" title=\"Edit $title\" >";
                    echo "<img class=\"icon\" src=\"assets/edit.png\" alt=\"Edit\">";
                    echo "</a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=\"$deleteUrl\" title=\"Delete $title\" >";
                    echo "<img class=\"icon\" src=\"assets/delete.png\" alt=\"Delete\">";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
    </div>
</div>

</body>