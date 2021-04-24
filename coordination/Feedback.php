<?php

require_once 'coordination/FormData.php';
require_once 'db/Applicants.php';
require_once 'db/ApplicantsRoles.php';
require_once 'db/Roles.php';
require_once 'db/Templates.php';
require_once 'db/Users.php';

// Extends FormData with feedback-specific fields
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

// a handler for the feedback pages
class FeedbackFormHandler
{
    // constructor instiates DBApplicants, DBApplicantsRoles, DBRoles, DBTemplates and DBUsers
    public function __construct()
    {
        $this->dbApplicants = new DBApplicants();
        $this->dbApplicantsRoles = new DBApplicantsRoles();
        $this->dbRoles = new DBRoles();
        $this->dbTemplates = new DBTemplates();
        $this->dbUsers = new DBUsers();
    }

    // handles the generation of feedback for applicants by combining information from
    // DBApplicants, DBApplicantsRoles, DBRoles, DBTemplates and DBUsers
    public function handleGenerateFeedback()
    {
        $data = new FeedbackFormData();
        $user = null;

        $data->applicants = $this->dbApplicants->listApplicants();
        $data->allRoles = $this->dbRoles->listRoles();
        $data->allTemplates = $this->dbTemplates->listTemplates();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data->applicantId = getPostParameter('applicantId');
            // if an applicantId has been POSTed, find the applicant
            if ($data->applicantId) {
                $data->applicant = $this->dbApplicants->getApplicant($data->applicantId);
                $data->applicantRoles = $this->dbApplicantsRoles->getRoleIdsForApplicant($data->applicantId)->getResult();
            }
            $data->roleId = getPostParameter('roleId');
            // if a roleId has been POSTed, find the role
            if ($data->roleId) {
                $data->role = $this->dbRoles->getRole($data->roleId);
            }
            $data->templateId = getPostParameter('templateId');
            $data->contents = getPostParameter('contents');
            // if a templateId has been POSTed, find the template
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
