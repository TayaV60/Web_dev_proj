<?php
include 'page_elements/Page.php';
include 'db/Roles.php';

$page = new Page("Roles", "Roles");

$dbRoles = new DBRoles();
$roles = $dbRoles->listRoles();


print $page->top();

?>

<a href="create_role.php">Create new role</a>

<br>
<br>
<table>
<?php 
    foreach ($roles as $value) {
        $id = $value["id"];
        $title = $value["title"];
        $editUrl = "edit_role.php?id=$id";
        $deleteUrl = "delete_role.php?id=$id";
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
</table>
<?php

print $page->bottom();
