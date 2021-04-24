<?php
require_once 'db_connection.php';

// extends DB to provide methods that query the Roles table
class DBRoles extends DB
{
    // returns a list of roles
    public function listRoles()
    {
        $query = "SELECT id, title FROM Roles";
        $dbResult = $this->query($query);
        return $dbResult->getResult();
    }

    // returns the role matching the provided $id
    public function getRole($id)
    {
        $query = "SELECT * FROM Roles WHERE id = :id ";
        $params = [":id" => $id];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }

    // creates a role
    public function createRole($title)
    {
        $query = 'INSERT INTO Roles (title) VALUES (:title)';
        $params = [":title" => $title];
        return $this->query($query, $params);
    }

    // updates a role
    public function editRole($id, $title)
    {
        $query = 'UPDATE Roles SET title = :title WHERE id = :id ';
        $params = [":title" => $title, ":id" => $id];
        return $this->query($query, $params);
    }

    // deletes a role
    public function deleteRole($id)
    {
        $query = 'DELETE FROM Roles WHERE id = :id';
        $params = [":id" => $id];
        return $this->query($query, $params);
    }
}
