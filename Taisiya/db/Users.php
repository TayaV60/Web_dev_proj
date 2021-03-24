<?php
require_once 'db_connection.php';

class DBUsers extends DB
{
    public function createUser($username, $password, $name_surname)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO Users (username, password, name_surname ) VALUES (:username, :hash, :name_surname)';
        $params = [":username" => $username, ":hash" => $hash, ":name_surname" => $name_surname];
        return $this->query($query, $params);
    }

    public function verifyUser($username, $password)
    {
        $query = 'SELECT username, password FROM Users WHERE username = :username';
        $params = [':username' => $username];
        $dbResult = $this->query($query, $params);
        $result = $dbResult->getResult();
        $found = false;
        foreach ($result as $row) {
            if (password_verify($password, $row['password'])) {
                $found = true;
            }
        }
        return $found;
    }

    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM Users WHERE username = :username';
        $params = [":username" => $username];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }
}
