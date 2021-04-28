<?php
require_once 'coordination/FormData.php';
require_once 'db/Applicants.php';
require_once 'db/ApplicantsRoles.php';
require_once 'db/Roles.php';

// Extends FormData to provide applicant specific information
class ApplicantFormData extends FormData
{
    // POST input field variables
    public $name = null;
    public $email = null;
    public $phone = null;
    public $allRoles = [];
    public $applicantRoles = [];

    // form state variables
    public $nameValidationError = null;
    public $emailValidationError = null;
    public $phoneValidationError = null;
    public $rolesValidationError = null;
}

// Extends DeletionData to provide applicant specific fields
class ApplicantDeletionData extends DeletionData
{
    public $name = null;
    public $email = null;
    public $phone = null;

    public $applicantRoleTitles = [];
}

// Contains a list of applicants and a list of all roles
class ApplicantListData
{
    public $applicants;
    public $allRoles;
}

function nameValidation($name)
{
    if (preg_match('/^[a-zA-Z\s]+$/', $name) && strlen($name_surname) > 3) {
        return true;
    }
    return false;
}

// validates the format of an email
function emailValidation($email)
{
    if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        return true;
    }
    return false;
}

// validates the format of a phone number
function phoneValidation($phone)
{
    if (preg_match('/^((\+44(\s\(0\)\s|\s0\s|\s)?)|0)7\d{3}(\s)?\d{6}$/', $phone)) {
        return true;
    }
    return false;
}

// will return a string "SELECTED" if the provided $id can be found in the $applicantRoles
function applicantSelected($id, $applicantRoles)
{
    $selected = "";
    if (in_array($id, $applicantRoles)) {
        $selected = "SELECTED";
    }
    return $selected;
}

// a handler for the applicant pages
class ApplicantFormHandler
{
    // constructor instantiates DBApplicants, DBRoles and DBApplicantsRoles
    public function __construct()
    {
        $this->dbApplicants = new DBApplicants();
        $this->dbRoles = new DBRoles();
        $this->dbApplicantsRoles = new DBApplicantsRoles();
    }

    // handles the retrieval of a list of applicants by invoking the DBApplicants' listApplicants method,
    // adding to each applicant the a list of roles they have applied for
    public function handleList()
    {
        $data = new ApplicantListData();
        $allApplicants = $this->dbApplicants->listApplicants();
        $data->applicants = [];
        $data->allRoles = $this->dbRoles->listRoles();
        foreach ($allApplicants as $applicant) {
            $applicant["titles"] = $this->getApplicantRoleTitles($data->allRoles, $applicant["id"]);
            $data->applicants[] = $applicant;
        }
        return $data;
    }

    // handles the creation or editing of an applicant by invoking either the createApplicant or editApplicant method
    public function handleCreateOrEdit()
    {
        $data = new ApplicantFormData();

        $data->allRoles = $this->dbRoles->listRoles();

        // if user has not posted yet, setup necessary default values
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($data->mode == 'edit') {
                // if editing, get the existing template from the DB
                $applicant = $this->dbApplicants->getApplicant($data->id);
                $data->name = $applicant["name"];
                $data->email = $applicant["email"];
                $data->phone = $applicant["phone"];
                $data->applicantRoles = $this->getRolesForApplicant($data->id);
            }

        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // collect value of input field
            $data->name = $_POST['name'];
            $data->email = $_POST['email'];
            $data->phone = $_POST['phone'];
            if (isset($_POST['applicantRoles'])) {
                $data->applicantRoles = $_POST['applicantRoles'];
            }

            if (nameValidation($data->name) == false) {
                $data->nameValidationError = "Please enter a valid name";
            }

            if (emailValidation($data->email) == false) {
                $data->emailValidationError = "The email format is incorrect";
            }

            if (phoneValidation($data->phone) == false) {
                $data->phoneValidationError = "The phone format is incorrect";
            }

            if (!$data->applicantRoles || count($data->applicantRoles) < 1) {
                $data->rolesValidationError = "Please select a role";
            }

            if (!$data->nameValidationError && !$data->emailValidationError && !$data->phoneValidationError && !$data->rolesValidationError) {
                $data->valid = true;
            }

            if ($data->valid && isset($_POST['save'])) {
                try {
                    if ($data->id && $data->mode == 'edit') {
                        // if there is an id and mode is edit, then try to save using the editTemplate method
                        $this->editApplicant($data->id, $data->name, $data->email, $data->phone, $data->applicantRoles);
                    } else {
                        // if not, try to create
                        $this->createApplicant($data->name, $data->email, $data->phone, $data->applicantRoles);
                    }
                    $data->saved = true;
                } catch (Exception $e) {
                    error_log($e);
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        $data->errorSaving = "Applicant already exists.";
                    } else {
                        $data->errorSaving = "Could not create applicant.";
                    }
                }
            }
        }

        $data->pageTitle = 'Create a new applicant';
        if ($data->mode == 'edit') {
            $data->pageTitle = 'Edit an applicant';
        }

        return $data;
    }

    // handles the deletion of a template by invoking the removeApplicant method
    public function handleDelete()
    {
        $data = new ApplicantDeletionData();

        $applicant = $this->dbApplicants->getApplicant($data->id);
        $data->name = $applicant["name"];
        $data->email = $applicant["email"];
        $data->phone = $applicant["phone"];

        $applicantRoles = $this->getRolesForApplicant($data->id);
        $roles = $this->dbRoles->listRoles();

        $data->applicantRoleTitles = [];
        foreach ($roles as $role) {
            $roleId = $role["id"];
            if (in_array($roleId, $applicantRoles)) {
                $data->applicantRoleTitles[] = $role["title"];
            }
        }

        if ($data->confirmed) {
            try {
                $result = $this->removeApplicant($data->id);
                $affectedRows = $result->getAffectedRows();
                $data->deleted = true;
                if ($affectedRows != 1) {
                    throw new Exception("Wrong number of rows deleted ($affectedRows)");
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
                $data->deletionError = "Could not delete $message";
            }
        }

        return $data;
    }

    // returns the role ids for an applicant as an array of strings
    private function getRolesForApplicant($applicantId)
    {
        $dbResult = $this->dbApplicantsRoles->getRoleIdsForApplicant($applicantId);
        $result = $dbResult->getResult();
        $ids = array();
        foreach ($result as $row) {
            $ids[] = $row["role_id"];
        }
        return $ids;
    }

    // creates an applicant and associates any selected roles to it
    private function createApplicant($name, $email, $phone, $roles)
    {
        $result = $this->dbApplicants->createApplicant($name, $email, $phone, $roles);
        $createdApplicant = $this->dbApplicants->getApplicantByName($name);
        $applicantId = $createdApplicant['id'];
        foreach ($roles as $roleId) {
            $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
        }
    }

    // edits an existing applicant, clearing all existing roles and adding back selected roles
    private function editApplicant($applicantId, $name, $email, $phone, $roles)
    {
        $editedApplicant = $this->dbApplicants->editApplicant($applicantId, $name, $email, $phone);
        $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
        foreach ($roles as $roleId) {
            $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
        }
    }

    // deletes the applicant, first clearing any roles it might have associated with it
    private function removeApplicant($applicantId)
    {
        $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
        return $this->dbApplicants->deleteApplicant($applicantId);
    }

    // returns a string of comma-separated role titles
    private function getApplicantRoleTitles($allRoles, $id)
    {
        $applicantRoleIds = $this->getRolesForApplicant($id);
        $titles = [];
        foreach ($applicantRoleIds as $applicantRoleId) {
            $titles[] = getRoleTitleFromId($applicantRoleId, $allRoles);
        }
        return implode(", ", $titles);
    }
}

// for a given id, will try to find a matching role and return its title
function getRoleTitleFromId($id, $allRoles)
{
    foreach ($allRoles as $role) {
        if ($role["id"] == $id) {
            return $role["title"];
        }
    }
}
