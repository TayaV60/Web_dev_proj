<?php
require_once 'db_connection.php';

// extends DB to provide methods that query the Applicants_Roles table
class DBApplicantsRoles extends DB
{
    // creates an Applicants_Roles entry
    public function createApplicantRole($applicantId, $roleId)
    {
        $query = 'INSERT INTO Applicants_Roles (applicant_id, role_id) VALUES (:applicantId, :roleId)';
        $params = [":applicantId" => $applicantId, ":roleId" => $roleId];
        return $this->query($query, $params);
    }

    // removes all Applicants_Roles entries that match the provided $applicantId
    public function clearApplicantRoles($applicantId)
    {
        $query = 'DELETE FROM Applicants_Roles WHERE applicant_id = :applicantId';
        $params = [":applicantId" => $applicantId];
        return $this->query($query, $params);
    }

    // retrieves all role ids that have Applicants_Roles entries that match the provided $applicantId
    public function getRoleIdsForApplicant($applicantId)
    {
        $query = 'SELECT role_id FROM Applicants_Roles WHERE applicant_id = :applicantId';
        $types = "i";
        $params = [":applicantId" => $applicantId];
        return $this->query($query, $params);
    }

}
