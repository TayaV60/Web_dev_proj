<?php

require_once 'coordination/FormData.php';
require_once 'db/Users.php';

function usernameValidation($username)
{
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $username)) {
        return false;
    }
    return true;
}

function passwordValidation($password)
{
    if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
        return false;
    }
    return true;
}

class RegistrationFormData extends FormData
{
    public $username = null;
    public $password = null;
    public $name_surname = null;

    public $usernameValidationError = null;
    public $passwordValidationError = null;
    public $namesurnameValidationError = null;
}

class RegistrationFormHandler
{
    public function __construct()
    {
        $this->dbUsers = new DBUsers();
    }

    public function handleRegistration()
    {
        $data = new RegistrationFormData();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data->username = $_POST['username'];
            $data->password = $_POST['password'];
            $data->name_surname = $_POST['name_surname'];

            if (usernameValidation($data->username) == false) {
                $data->usernameValidationError = "The username format is incorrect";
            }

            if (passwordValidation($data->password) == false) {
                $data->passwordValidationError = "The password is weak";
            }

            if (strlen($data->name_surname) < 1) {
                $data->namesurnameValidationError = "Please enter your name and surname";
            }

            if (!$data->usernameValidationError && !$data->passwordValidationError && !$data->namesurnameValidationError) {
                $data->valid = true;
            }

            if ($data->valid && isset($_POST['save'])) {
                try {
                    $this->dbUsers->createUser($data->username, $data->password, $data->name_surname);
                    $data->saved = true;
                } catch (Exception $e) {
                    $message = $e->getMessage();
                    error_log($e);
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        $data->errorSaving = "User already exists.";
                    } else {
                        $data->errorSaving = "Could not create user.";
                    }
                }
            }
        }

        return $data;
    }
}
