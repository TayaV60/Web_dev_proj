<?php

require_once 'coordination/Applicants.php';
require_once 'page_elements/Page.php';

$page = new Page("Applicants", "Applicants");

$handler = new ApplicantFormHandler();
$data = $handler->handleList();

print $page->top();

?>

<a class='links' href="create_or_edit_applicant.php">Create new applicant</a>
<br>
<br>
<table>
<thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Roles</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->applicants as $value): ?>
            <tr>
                <td>
                    <?=$value["name"]?>
                </td>
                <td>
                    <?=$value["email"]?>
                </td>
                <td>
                    <?=$value["phone"]?>
                </td>
                <td>
                    <?=$value["titles"]?>
                </td>
                <td>
                    <a href="create_or_edit_applicant.php?id=<?=$value["id"]?>" value="Edit <?=$value["name"]?>" >
                        <img class="icon" src="assets/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="delete_applicant.php?id=<?=$value["id"]?>" value="Delete <?=$value["name"]?>" >
                        <img class="icon" src="assets/delete.png" alt="Delete">
                    </a>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>

<?php

print $page->bottom();
