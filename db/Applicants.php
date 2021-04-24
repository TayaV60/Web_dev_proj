<?php
require_once 'db_connection.php';

// extends DB to provide methods that query the Applicants table
class DBApplicants extends DB
{
    // returns a list of applicants
    public function listApplicants()
    {
        $query = "SELECT id, name, email, phone FROM Applicants";
        $dbResult = $this->query($query);
        return $dbResult->getResult();
    }

    // returns an applicant
    public function getApplicant($id)
    {
        $query = "SELECT * FROM Applicants WHERE id = :id ";
        $params = [":id" => $id];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }

    // returns an applicant matching by name
    public function getApplicantByName($name)
    {
        $query = "SELECT * FROM Applicants WHERE name = :name ";
        $params = [":name" => $name];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }

    // creates an applicant
    public function createApplicant($name, $email, $phone)
    {
        $query = 'INSERT INTO Applicants (name, email, phone) VALUES (:name, :email, :phone)';
        $params = [":name" => $name, ":email" => $email, ":phone" => $phone];
        return $this->query($query, $params);
    }

    // updates an applicant
    public function editApplicant($id, $name, $email, $phone)
    {
        $query = 'UPDATE Applicants SET name = :name, email = :email, phone = :phone WHERE id = :id';
        $params = [":name" => $name, ":email" => $email, ":phone" => $phone, ":id" => $id];
        return $this->query($query, $params);
    }

    // deletes an applicant
    public function deleteApplicant($id)
    {
        $query = 'DELETE FROM Applicants WHERE id = :id';
        $params = [":id" => $id];
        return $this->query($query, $params);
    }

}
