<?php

require_once 'coordination/Applicants.php';
require_once 'coordination/FormData.php';
require_once 'db/Templates.php';
require_once 'db/Users.php';

class FeedbackFormData extends FormData
{
    //POST input field variables
    public $applicantId = null;
    public $templateId = null;
    public $roleId = null;
    public $selectedComments = [];

    // form state variables
    public $preview = false;

    // variables from database
    public $applicantRoles = null;
    public $applicant = null;
    public $role = null;
    public $template = null;
    public $contents = "";
    public $comments = [];
}

class FeedbackFormHandler
{
    public function __construct()
    {
        $this->applicantHandler = new ApplicantFormHandler();
        $this->dbTemplates = new DBTemplates();
        $this->dbUsers = new DBUsers();
    }

    public function handleGenerateFeedback()
    {
        $data = new FeedbackFormData();
        $user = null;

        $data->applicants = $this->applicantHandler->listApplicants();
        $data->allRoles = $this->applicantHandler->listRoles();
        $data->allTemplates = $this->dbTemplates->listTemplates();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data->applicantId = getPostParameter('applicantId');
            if ($data->applicantId) {
                $data->applicant = $this->applicantHandler->getApplicant($data->applicantId);
                $data->applicantRoles = $this->applicantHandler->getRolesForApplicant($data->applicantId);
            }
            $data->roleId = getPostParameter('roleId');
            if ($data->roleId) {
                $data->role = $this->applicantHandler->getRole($data->roleId);
            }
            $data->templateId = getPostParameter('templateId');
            $data->contents = getPostParameter('contents');
            if ($data->templateId) {
                // the template is needed to generate contents and to hide the select
                $data->template = $this->dbTemplates->getTemplate($data->templateId);
                // we need the comments to make the checkboxes and the preview
                $data->comments = $data->template["comments"];
                // if no contents posted, generate a first version of the template
                if (!$data->contents) {
                    $username = $_SESSION['username'];
                    $user = $this->dbUsers->getUserByUsername($username);
                    $data->contents = $data->template["contents"];
                    $data->contents = str_replace("{{applicant_name}}", $data->applicant["name"], $data->contents);
                    $data->contents = str_replace("{{applicant_email}}", $data->applicant["email"], $data->contents);
                    $date = new DateTime();
                    $data->contents = str_replace("{{date}}", $date->format('d/m/y'), $data->contents);
                    $data->contents = str_replace("{{position_title}}", $data->role["title"], $data->contents);
                    $data->contents = str_replace("{{interviewer_name}}", $user["name_surname"], $data->contents);
                    $data->contents = str_replace("{{interviewer_email}}", $user["username"], $data->contents);
                }
            }
            if (isset($_POST["selectedComments"])) {
                $data->selectedComments = $_POST["selectedComments"];
            }
            if (isset($_POST['preview'])) {
                $data->preview = true;
            }
        }

        return $data;
    }
}
