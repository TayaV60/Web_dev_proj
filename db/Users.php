<?php
require_once 'db_connection.php';

// extends DB to provide methods that query the Users table
class DBUsers extends DB
{
    // creates a user
    public function createUser($username, $password, $name_surname)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO Users (username, password, name_surname ) VALUES (:username, :hash, :name_surname)';
        $params = [":username" => $username, ":hash" => $hash, ":name_surname" => $name_surname];
        return $this->query($query, $params);
    }

    // verifies a user has the provided password
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

    // get a user that has the provided username
    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM Users WHERE username = :username';
        $params = [":username" => $username];
        $dbResult = $this->query($query, $params);
        return $dbResult->getResult()[0];
    }
}
