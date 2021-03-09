<?php
include_once 'db_connection.php';

class DBApplicantsRoles extends DB {

    public function createApplicantRole($applicantId, $roleId) {
        $query = 'INSERT INTO Applicants_Roles (applicant_id, role_id) VALUES (?, ?)';
        $types = "ii";
        $params = [$applicantId, $roleId];
        return $this->query($query, $types, $params);
    }

    public function clearApplicantRoles($applicantId) {
        $query = 'DELETE FROM Applicants_Roles WHERE applicant_id = ?';
        $types = "i";
        $params = [$applicantId];
        return $this->query($query, $types, $params);
    }

    public function getRoleIdsForApplicant($applicantId) {
        $query = 'SELECT role_id FROM Applicants_Roles WHERE applicant_id = ?';
        $types = "i";
        $params = [$applicantId];
        return $this->query($query, $types, $params);
    }
    
}

