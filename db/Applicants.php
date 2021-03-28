<?php
require_once 'db_connection.php';

class DBApplicants extends DB
{

    public function listApplicants()
    {
        $query = "SELECT id, name, email, phone FROM Applicants";
        $dbResult = $this->query($query);
        return $dbResult->getResult();
    }

    public function getApplicant($id)
    {
        $query = "SELECT * FROM Applicants WHERE id = :id ";
        $params = [":id" => $id];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }

    public function getApplicantByName($name)
    {
        $query = "SELECT * FROM Applicants WHERE name = :name ";
        $params = [":name" => $name];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }

    public function createApplicant($name, $email, $phone)
    {
        $query = 'INSERT INTO Applicants (name, email, phone) VALUES (:name, :email, :phone)';
        $params = [":name" => $name, ":email" => $email, ":phone" => $phone];
        return $this->query($query, $params);
    }

    public function editApplicant($id, $name, $email, $phone)
    {
        $query = 'UPDATE Applicants SET name = :name, email = :email, phone = :phone WHERE id = :id';
        $params = [":name" => $name, ":email" => $email, ":phone" => $phone, ":id" => $id];
        return $this->query($query, $params);
    }

    public function deleteApplicant($id)
    {
        $query = 'DELETE FROM Applicants WHERE id = :id';
        $params = [":id" => $id];
        return $this->query($query, $params);
    }

}
