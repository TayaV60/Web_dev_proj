<?php
include_once 'db_connection.php';

class DBUsers extends DB
{
    public function createUser($username, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO Users (user_email, user_password) VALUES (:username, :hash)';
        $params = [":username" => $username, ":hash" => $hash];
        return $this->query($query, $params);
    }

    public function verifyUser($username, $password)
    {
        $query = 'SELECT user_email, user_password FROM Users WHERE user_email = :username';
        $params = [':username' => $username];
        $dbResult = $this->query($query, $params);
        $result = $dbResult->getResult();
        $found = false;
        foreach ($result as $row) {
            if (password_verify($password, $row['user_password'])) {
                $found = true;
            }
        }
        return $found;
    }
}
