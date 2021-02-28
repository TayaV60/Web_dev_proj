<?php
include 'db_connection.php';

class DBApplicants {
    private $conn;

    public function __construct() {
        $this->conn = OpenCon();
    }

    public function listApplicants() {
        $result = $this->conn->query("SELECT id, name, position, email, phone FROM Applicants");
        $applicants = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $applicants[] = $row; // append each row to the $templates array
            }
        }
        return $applicants;  
    }

    public function getApplicants($id) {
        $result = $this->conn->query("SELECT * FROM Applicants WHERE id = '$id' ");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row; 
            }
        }
    }

    public function createApplicant($name, $position, $email, $phone) {
        $stmt = $this->conn->prepare('INSERT INTO Applicants (name, position, email, phone) VALUES (?, ?, ?, ?)');
        $stmt->bind_param("ssss", $name, $position, $email, $phone);
        $stmt->execute();
      
        $stmt->close();
    }

    public function editApplicant($id, $name, $position, $email, $phone) {
      $stmt = $this->conn->prepare('UPDATE Applicants SET name = ?, position = ?, email = ?, phone = ? WHERE id = ?'); 
      $stmt->bind_param("ssssi", $name, $position, $email, $phone, $id);
      
      $stmt->execute();
    
      $stmt->close();
    }

    public function deleteApplicant($id) {
        $stmt = $this->conn->prepare("DELETE FROM Applicants WHERE id = ?");
    
        // Check if prepare() failed.
        if ( false === $stmt ) {
            error_log('mysqli prepare() failed: ');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
            return 0;
        }
    
        // Bind the value to the statement
        $bind = $stmt->bind_param('i', $id);
        
        // Check if bind_param() failed.
        if ( false === $bind ) {
            error_log('bind_param() failed:');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
            return 0;
        }
    
        $exec = $stmt->execute();
        // Check if execute() failed. 
        if ( false === $exec ) {
            error_log('mysqli execute() failed: ');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
            return 0;
        }
    
        return $stmt->affected_rows;
    }
    

    public function __destruct() {
        CloseCon($this->conn);
    }
}

