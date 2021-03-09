<?php
include 'page_elements/Page.php';
include 'coordination/Applicants.php';

$page = new Page("Applicants", "Applicants");

$coApplicants = new ApplicantsCoordinator();
$applicants = $coApplicants->listApplicants();
$roles = $coApplicants->listRoles();

function getRole($roles, $roleId) {
    foreach($roles as $role) {
        if ($roleId == $role["id"]) {
            return $role;
        }
    }
}

print $page->top();

?>

<a href="create_applicant.php">Create new applicant</a>

<br>
<br>
<table>
<?php 
    foreach ($applicants as &$value) {
        $id = $value["id"];
        $name = $value["name"];
        $email = $value ["email"];
        $phone = $value ["phone"];
        $editUrl = "edit_applicant.php?id=$id";
        $deleteUrl = "delete_applicant.php?id=$id";

        $applicantRoleIds = $coApplicants->getRolesForApplicant($id);
        $rolesToPrint = [];
        foreach($applicantRoleIds as $applicantRoleId) {
            $role = getRole($roles, $applicantRoleId);
            $rolesToPrint[] = $role['title'];
        }

        echo "<tr>";
        echo "<td>";
        echo $name;
        echo "</td>";
        echo "<td>";
        echo $email;
        echo "</td>";
        echo "<td>";
        echo $phone;
        echo "</td>";
        echo "<td>";
        echo implode(", ", $rolesToPrint);
        echo "</td>";
        echo "<td>";
        echo "<a href=\"$editUrl\" title=\"Edit $name\" >";
        echo "<img class=\"icon\" src=\"assets/edit.png\" alt=\"Edit\">";
        echo "</a>";
        echo "</td>";
        echo "<td>";
        echo "<a href=\"$deleteUrl\" title=\"Delete $name\" >";
        echo "<img class=\"icon\" src=\"assets/delete.png\" alt=\"Delete\">";
        echo "</a>";
        echo "</td>";
        echo "</tr>";
    }
?>
</table>
<?php

print $page->bottom();
