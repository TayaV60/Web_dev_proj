<?php

require_once 'db/Users.php';

class LoginFormData
{
    public $error = null;
}

class LoginFormHandler
{

    public function __construct()
    {
        $this->dbUsers = new DBUsers();
    }

    public function handleLogin()
    {
        $data = new LoginFormData();
        $data->error = null;

        if (!isset($_SESSION['username'])) {
            // See if a login form was submitted with a username for login
            if (isset($_POST['username']) && isset($_POST['password'])) {
                // get the username
                $username = htmlentities(trim($_POST['username']));
                // get the password
                $password = htmlentities(trim($_POST['password']));

                if (!$username || !$password) {
                    $error = "You need to fill in both the username and password.";
                }

                $userverified = $this->dbUsers->verifyUser($username, $password);

                if ($userverified) {
                    $_SESSION['username'] = $username;

                    header("Location: index.php");
                    exit();
                } else {
                    $data->error = "You need a valid username and password.";
                }
            }
        } else {
            header("Location: index.php");
            exit();
        }

        return $data;
    }

}
