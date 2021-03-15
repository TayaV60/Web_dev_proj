<?php
include 'db/Applicants.php';
include 'db/ApplicantsRoles.php';
include 'db/Roles.php';

class ApplicantsCoordinator
{
    public function __construct()
    {
        $this->dbApplicants = new DBApplicants();
        $this->dbRoles = new DBRoles();
        $this->dbApplicantsRoles = new DBApplicantsRoles();
    }

    public function getApplicant($id)
    {
        $applicant = $this->dbApplicants->getApplicant($id);
        return $applicant;
    }

    public function listApplicants()
    {
        $applicants = $this->dbApplicants->listApplicants();
        return $applicants;
    }

    public function listRoles()
    {
        $roles = $this->dbRoles->listRoles();
        return $roles;
    }

    public function getRolesForApplicant($applicantId)
    {
        $dbResult = $this->dbApplicantsRoles->getRoleIdsForApplicant($applicantId);
        $result = $dbResult->getResult();
        $ids = array();
        foreach ($result as $row) {
            $ids[] = $row["role_id"];
        }
        return $ids;
    }

    public function createApplicant($name, $email, $phone, $roles)
    {
        try {
            $result = $this->dbApplicants->createApplicant($name, $email, $phone, $roles);
            $createdApplicant = $this->dbApplicants->getApplicantByName($name);
            $applicantId = $createdApplicant['id'];
            foreach ($roles as $roleId) {
                $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            error_log('Create applicant failed: ');
            error_log(print_r(htmlspecialchars($message), true));
            throw new Exception("Create applicant failed");
        }
    }

    public function editApplicant($applicantId, $name, $email, $phone, $roles)
    {
        try {
            $editedApplicant = $this->dbApplicants->editApplicant($applicantId, $name, $email, $phone);
            $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
            foreach ($roles as $roleId) {
                $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            error_log('Edit applicant failed: ');
            error_log(print_r(htmlspecialchars($message), true));
            throw new Exception("Edit applicant failed");
        }
    }

    public function removeApplicant($applicantId)
    {
        $message_to_user = '';
        try {
            $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
            $this->dbApplicants->deleteApplicant($applicantId);
            $message_to_user = "Applicant '$applicantId' deleted successfully.";
        } catch (Exception $e) {
            $message = $e->getMessage();
            $message_to_user = "Could not delete applicant. $message";
        }
        return $message_to_user;
    }
}

function getRoleTitleFromId($id, $allRoles)
{
    foreach ($allRoles as $role) {
        if ($role["id"] == $id) {
            return $role["title"];
        }
    }
}
