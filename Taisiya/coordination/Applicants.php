<?php
require_once 'db/Applicants.php';
require_once 'db/ApplicantsRoles.php';
require_once 'db/Roles.php';

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

    public function getRole($id)
    {
        return $this->dbRoles->getRole($id);
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
        try {
            $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
            return $this->dbApplicants->deleteApplicant($applicantId);
        } catch (Exception $e) {
            $message = $e->getMessage();
            error_log('Remove applicant failed: ');
            error_log(print_r(htmlspecialchars($message), true));
            throw new Exception("Remove applicant failed");
        }
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
