<?php
require_once 'coordination/FormData.php';
require_once 'db/Applicants.php';
require_once 'db/ApplicantsRoles.php';
require_once 'db/Roles.php';

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

class ApplicantDeletionData extends DeletionData
{
    public $name = null;
    public $email = null;
    public $phone = null;

    public $applicantRoleTitles = [];
}

class ApplicantListData
{
    public $applicants;
    public $allRoles;
}

function emailValidation($email)
{
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        return false;
    }
    return true;
}

function phoneValidation($phone)
{
    if (!preg_match('/^((\+44(\s\(0\)\s|\s0\s|\s)?)|0)7\d{3}(\s)?\d{6}$/', $phone)) {
        return false;
    }
    return true;
}

function applicantSelected($id, $applicantRoles)
{
    $selected = "";
    if (in_array($id, $applicantRoles)) {
        $selected = "SELECTED";
    }
    return $selected;
}

class ApplicantFormHandler
{
    public function __construct()
    {
        $this->dbApplicants = new DBApplicants();
        $this->dbRoles = new DBRoles();
        $this->dbApplicantsRoles = new DBApplicantsRoles();
    }

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

            if (strlen($data->name) < 2) {
                $data->nameValidationError = "Name is too short";
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

    private function createApplicant($name, $email, $phone, $roles)
    {
        $result = $this->dbApplicants->createApplicant($name, $email, $phone, $roles);
        $createdApplicant = $this->dbApplicants->getApplicantByName($name);
        $applicantId = $createdApplicant['id'];
        foreach ($roles as $roleId) {
            $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
        }
    }

    private function editApplicant($applicantId, $name, $email, $phone, $roles)
    {

        $editedApplicant = $this->dbApplicants->editApplicant($applicantId, $name, $email, $phone);
        $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
        foreach ($roles as $roleId) {
            $this->dbApplicantsRoles->createApplicantRole($applicantId, $roleId);
        }
    }

    private function removeApplicant($applicantId)
    {
        $this->dbApplicantsRoles->clearApplicantRoles($applicantId);
        return $this->dbApplicants->deleteApplicant($applicantId);
    }

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

function getRoleTitleFromId($id, $allRoles)
{
    foreach ($allRoles as $role) {
        if ($role["id"] == $id) {
            return $role["title"];
        }
    }
}
