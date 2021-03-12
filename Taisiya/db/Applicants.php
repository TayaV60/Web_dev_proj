<?php
include_once 'db_connection.php';

class DBApplicants extends DB {

    public function listApplicants() {
        $query = "SELECT id, name, email, phone FROM Applicants";
        $dbResult = $this->query($query);
        $result = $dbResult->getResult();
        $applicants = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $applicants[] = $row; // append each row to the $templates array
            }
        }
        return $applicants;  
    }

    public function getApplicant($id) {
        $query = "SELECT * FROM Applicants WHERE id = ? ";
        $types = "i";
        $params = [$id];
        $dbResult = $this->query($query, $types, $params);
        $result = $dbResult->getResult();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row; 
            }
        }
    }

    public function getApplicantByName($name) {
        $query = "SELECT * FROM Applicants WHERE name = ? ";
        $types = "s";
        $params = [$name];
        $dbResult = $this->query($query, $types, $params);
        $result = $dbResult->getResult();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row; 
            }
        }
    }


    public function createApplicant($name, $email, $phone) {
        $query = 'INSERT INTO Applicants (name, email, phone) VALUES (?, ?, ?)';
        $types = "sss";
        $params = [$name, $email, $phone];
        return $this->query($query, $types, $params);
    }


    public function editApplicant($id, $name, $email, $phone) {
        $query = 'UPDATE Applicants SET name = ?, email = ?, phone = ? WHERE id = ?'; 
        $types = "sssi";
        $params = [$name, $email, $phone, $id];
        return $this->query($query, $types, $params);
    }


    public function deleteApplicant($id) {
        $query = 'DELETE FROM Applicants WHERE id = ?';
        $types = "i";
        $params = [$id];
        return $this->query($query, $types, $params);
    }
    
}

