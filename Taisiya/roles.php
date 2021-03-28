<?php
require_once 'db/Roles.php';
require_once 'page_elements/Page.php';

$page = new Page("Roles", "Roles");

$dbRoles = new DBRoles();
$roles = $dbRoles->listRoles();

print $page->top();

?>

<a class='links' href="create_or_edit_role.php">Create new role</a>
<br>
<br>
<table>
    <thead>
        <tr>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td>
                    <?=$role["title"]?>
                </td>
                <td>
                    <a href="create_or_edit_role.php?id=<?=$role["id"]?>" title="Edit <?=$role["title"]?>" >
                        <img class="icon" src="assets/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="delete_role.php?id=<?=$role["id"]?>" title="Delete <?=$role["title"]?>" >
                        <img class="icon" src="assets/delete.png" alt="Delete">
                    </a>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<?php

print $page->bottom();
