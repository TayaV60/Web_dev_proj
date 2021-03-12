<?php
include_once 'db_connection.php';

class DBRoles extends DB
{
    public function listRoles()
    {
        $query = "SELECT id, title FROM Roles";
        $dbResult = $this->query($query);
        return $dbResult->getResult();
    }

    public function getRole($id)
    {
        $query = "SELECT * FROM Roles WHERE id = :id ";
        $params = [":id" => $id];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }

    public function createRole($title)
    {
        $query = 'INSERT INTO Roles (title) VALUES (:title)';
        $params = [":title" => $title];
        return $this->query($query, $params);
    }

    public function editRole($id, $title)
    {
        $query = 'UPDATE Roles SET title = :title WHERE id = :id ';
        $params = [":title" => $title, ":id" => $id];
        return $this->query($query, $params);
    }

    public function deleteRole($id)
    {
        $query = 'DELETE FROM Roles WHERE id = :id';
        $params = [":id" => $id];
        return $this->query($query, $params);
    }
}
