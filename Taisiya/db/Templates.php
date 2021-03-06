<?php
include 'db_connection.php';

class DBTemplates extends DB {

    public function listTemplates() {
        $query = "SELECT id, title FROM Templates";
        $dbResult = $this->query($query);
        $result = $dbResult->getResult();
        $templates = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $templates[] = $row; // append each row to the $templates array
            }
        }
        return $templates;
    }

    public function getTemplate($id) {
        $query = "SELECT * FROM Templates WHERE id = ? ";
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

    public function createTemplate($title, $contents, $comments) {
        $commentsJoined = implode("::::", $comments);
        $query = 'INSERT INTO Templates (title, contents, comments) VALUES (?, ?, ?)';
        $types = "sss";
        $params = [$title, $contents, $commentsJoined];
        return $this->query($query, $types, $params);
    }

    public function editTemplate($id, $title, $contents, $comments) {
        $commentsJoined = implode("::::", $comments);
        $query = 'UPDATE Templates SET title = ?, contents = ?, comments = ? WHERE id = ?';
        $types = "sssi";
        $params = [$title, $contents, $commentsJoined, $id];
        return $this->query($query, $types, $params);
    }

    public function deleteTemplate($id) {
        $query = 'DELETE FROM Templates WHERE id = ?';
        $types = "i";
        $params = [$id];
        return $this->query($query, $types, $params);
    }
    
}
