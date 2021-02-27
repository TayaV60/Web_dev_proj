<?php
include 'page_elements/Page.php';
include 'db/Templates.php';

$page = new Page("List existing templates", "Templates");

$dbTemplates = new DBTemplates();
$templates = $dbTemplates->listTemplates(); 

print $page->top();

?>

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
</table>
<?php

print $page->bottom();
