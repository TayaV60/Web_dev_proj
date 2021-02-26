<?php
include 'db_connection.php';

class DBTemplates {
    private $conn;

    public function __construct() {
        $this->conn = OpenCon();
    }

    public function listTemplates() {
        $result = $this->conn->query("SELECT id, title FROM Templates");
        $templates = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $templates[] = $row; // append each row to the $templates array
            }
        }
        return $templates;
    }

    public function getTemplate($id) {
        $result = $this->conn->query("SELECT * FROM Templates WHERE id = '$id' ");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row; 
            }
        }
    }

    public function createTemplate($title, $contents, $comments) {
        $stmt = $this->conn->prepare('INSERT INTO Templates (title, contents, comments) VALUES (?, ?, ?)');
        $commentsJoined = implode("::::", $comments);
        $stmt->bind_param("sss", $title, $contents, $commentsJoined);
        $stmt->execute();
      
        $stmt->close();
    }

    public function editTemplate($id, $title, $contents, $comments) {
      $stmt = $this->conn->prepare('UPDATE Templates SET title = ?, contents = ?, comments = ? WHERE id = ?'); 
      $commentsJoined = implode("::::", $comments);
      $stmt->bind_param("sssi", $title, $contents, $commentsJoined, $id);
      
      $stmt->execute();
    
      $stmt->close();
    }

    public function deleteTemplate($id) {
        $stmt = $this->conn->prepare("DELETE FROM Templates WHERE id = ?");
    
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
