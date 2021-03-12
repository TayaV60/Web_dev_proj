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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ids[] = $row["role_id"]; // append each row to the $templates array
            }
        }
        return $ids;
    }

    public function createApplicant($name, $email, $phone, $roles)
    {
        $message_to_user = '';
        try {
            $result = $this->dbApplicants->createApplicant($name, $email, $phone, $roles);
            $createdApplicant = $this->dbApplicants->getApplicantByName($name);
            $applicantId = $createdApplicant['id'];
            foreach ($roles as $roleId) {
                $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
            }
            $message_to_user = "Applicant '$name' created successfully. The email is $email and their phone number is $phone.";
        } catch (Exception $e) {
            $message = $e->getMessage();
            $message_to_user = "Could not add applicant. $message";
        }
        return $message_to_user;
    }

    public function updateApplicant($applicantId, $name, $email, $phone, $roles)
    {
        $message_to_user = '';
        try {
            $editedApplicant = $this->dbApplicants->editApplicant($applicantId, $name, $email, $phone);
            $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
            foreach ($roles as $roleId) {
                $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
            }
            $message_to_user = "Applicant '$name' created successfully. The email is $email and their phone number is $phone.";
        } catch (Exception $e) {
            $message = $e->getMessage();
            $message_to_user = "Could not update applicant. $message";
        }
        return $message_to_user;
    }

    public function removeApplicant($applicantId) {
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
