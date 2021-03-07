<?php
include 'db_connection.php';

class DBRoles extends DB {
    public function listRoles() {
        $query = "SELECT id, title FROM Roles";
        $dbResult = $this->query($query);
        $result = $dbResult->getResult();
        $roles = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $roles[] = $row; // append each row to the $templates array
            }
        }
        return $roles;  
    }

    public function getRoles($id) {
        $query = "SELECT * FROM Roles WHERE id = ? ";
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

    public function createRole($title) {
        $query = 'INSERT INTO Roles (title) VALUES (?)';
        $types = "s";
        $params = [$title];
        return $this->query($query, $types, $params);
    }

    public function editRole($id, $title) {
        $query = 'UPDATE Roles SET title = ? WHERE id = ?'; 
        $types = "si";
        $params = [$title, $id];
        return $this->query($query, $types, $params);
      }

    public function deleteRole($id) {
        $query = 'DELETE FROM Roles WHERE id = ?';
        $types = "i";
        $params = [$id];
        return $this->query($query, $types, $params);
    }
}