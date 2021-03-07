<?php
include 'db_connection.php';

class DBApplicants extends DB {

    public function listApplicants() {
        $query = "SELECT id, name, position, email, phone FROM Applicants";
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

    public function getApplicants($id) {
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


    public function createApplicant($name, $position, $email, $phone) {
        $query = 'INSERT INTO Applicants (name, position, email, phone) VALUES (?, ?, ?, ?)';
        $types = "ssss";
        $params = [$name, $position, $email, $phone];
        return $this->query($query, $types, $params);
    }


    public function editApplicant($id, $name, $position, $email, $phone) {
      $query = 'UPDATE Applicants SET name = ?, position = ?, email = ?, phone = ? WHERE id = ?'; 
      $types = "ssssi";
      $params = [$name, $position, $email, $phone, $id];
      return $this->query($query, $types, $params);
    }


    public function deleteApplicant($id) {
        $query = 'DELETE FROM Applicants WHERE id = ?"';
        $types = "i";
        $params = [$id];
        return $this->query($query, $types, $params);
    }
    
}

