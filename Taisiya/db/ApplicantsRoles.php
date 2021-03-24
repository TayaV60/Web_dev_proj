<?php
require_once 'db_connection.php';

class DBApplicantsRoles extends DB
{

    public function createApplicantRole($applicantId, $roleId)
    {
        $query = 'INSERT INTO Applicants_Roles (applicant_id, role_id) VALUES (:applicantId, :roleId)';
        $params = [":applicantId" => $applicantId, ":roleId" => $roleId];
        return $this->query($query, $params);
    }

    public function clearApplicantRoles($applicantId)
    {
        $query = 'DELETE FROM Applicants_Roles WHERE applicant_id = :applicantId';
        $params = [":applicantId" => $applicantId];
        return $this->query($query, $params);
    }

    public function getRoleIdsForApplicant($applicantId)
    {
        $query = 'SELECT role_id FROM Applicants_Roles WHERE applicant_id = :applicantId';
        $types = "i";
        $params = [":applicantId" => $applicantId];
        return $this->query($query, $params);
    }

}
