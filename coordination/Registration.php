<?php

require_once 'coordination/FormData.php';
require_once 'db/Users.php';

// validates username format
function usernameValidation($username)
{
    if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $username)) {
        return true;
    }
    return false;
}

// validates password format
function passwordValidation($password)
{
    if (preg_match('/[A-Za-z\s].*[0-9]|[0-9].*[A-Za-z\s]/', $password) && strlen($password) > 6) {
        return true;
    }
    return false;
}
// validates format of the name and surname of the user
function namesurnameValidation($name_surname)
{
    if (preg_match('/^[a-zA-Z\s]+$/', $name_surname) && strlen($name_surname) > 3) {
        return true;
    }
    return false;
}

// Extends form data to include registration info
class RegistrationFormData extends FormData
{
    // POST input field variables
    public $username = null;
    public $password = null;
    public $name_surname = null;

    // form state variables
    public $usernameValidationError = null;
    public $passwordValidationError = null;
    public $namesurnameValidationError = null;
}

// A handler class for registration
class RegistrationFormHandler
{
    // constructor instantiates a DBUsers
    public function __construct()
    {
        $this->dbUsers = new DBUsers();
    }

    // a handler method for the registration form
    public function handleRegistration()
    {
        $data = new RegistrationFormData();

        // if user has posted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // extract value of input fields from $_POST
            $data->username = $_POST['username'];
            $data->password = $_POST['password'];
            $data->name_surname = $_POST['name_surname'];

            // validate username
            if (usernameValidation($data->username) == false) {
                $data->usernameValidationError = "Enter a valid email address";
            }

            // validate password
            if (passwordValidation($data->password) == false) {
                $data->passwordValidationError = "The password must contain numbers and letters and be longer than six characters";
            }

            // validate name and surname
            if (namesurnameValidation($data->name_surname) == false) {
                $data->namesurnameValidationError = "Please enter your name and surname";
            }

            // if all fields are valid, then the form is valid
            if (!$data->usernameValidationError && !$data->passwordValidationError && !$data->namesurnameValidationError) {
                $data->valid = true;
            }

            // if the form is valid, the submit button will post a "save", so we can try to save
            if ($data->valid && isset($_POST['save'])) {
                try {
                    //try saving using the createUser method
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
