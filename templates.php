<?php
require_once 'coordination/Templates.php';
require_once 'page_elements/Page.php';

$page = new Page("List existing templates", "Templates");

$handler = new TemplateFormHandler();
$data = $handler->handleList();

print $page->top();

?>

<a class='links' href="create_or_edit_template.php">Create new template</a>
<br>
<br>
<table>
    <thead>
        <tr>
            <th>Template</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->templates as $template): ?>
            <tr>
                <td>
                    <?=$template["title"]?>
                </td>
                <td>
                    <a href="create_or_edit_template.php?id=<?=$template["id"]?>" title="Edit <?=$template["title"]?>" >
                        <img class="icon" src="assets/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="delete_template.php?id=<?=$template["id"]?>" title="Delete <?=$template["title"]?>" >
                        <img class="icon" src="assets/delete.png" alt="Delete">
                    </a>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<?php

print $page->bottom();
