<?php
require_once 'coordination/Applicants.php';
require_once 'page_elements/Page.php';

function getApplicantRoleTitles($coApplicants, $allRoles, $id)
{
    $applicantRoleIds = $coApplicants->getRolesForApplicant($id);
    $titles = [];
    foreach ($applicantRoleIds as $applicantRoleId) {
        $titles[] = getRoleTitleFromId($applicantRoleId, $allRoles);
    }
    return implode(", ", $titles);
}

$page = new Page("Applicants", "Applicants");

$coApplicants = new ApplicantsCoordinator();
$applicants = $coApplicants->listApplicants();
$allRoles = $coApplicants->listRoles();

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
        <?php foreach ($applicants as $value): ?>
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
                    <?=getApplicantRoleTitles($coApplicants, $allRoles, $value["id"])?>
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
