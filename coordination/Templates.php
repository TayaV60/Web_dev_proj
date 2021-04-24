<?php

require_once 'coordination/FormData.php';
require_once 'coordination/Supporting_functions.php';
require_once 'db/Templates.php';

// Extends FormData with template-specific fields
class TemplateFormData extends FormData
{
    // POST input field variables
    public $comments = [];
    public $contents = null;
    public $title = null;

    // form state variables
    public $titleValidationError = null;
    public $contentsValidationError = null;
    public $commentsValidationError = null;
}

// Extends DeletionData with template specific-fields
class TemplateDeletionData extends DeletionData
{
    public $contents = null;
    public $title = null;
    public $comments = null;
}

// Contains a list of templates
class TemplateListData
{
    public $templates;
}

// a hanlder class for template pages
class TemplateFormHandler
{
    // A default template to be used if in 'create' mode.
    private $DEFAULT_TEMPLATE = "{{date}}
{{applicant_name}}
{{applicant_email}}

Dear {{applicant_name}},

Thank you for your application to the position of {{position_title}} at HappyTech.
We wish you all the best in your job search.

Best wishes,
{{interviewer_name}}
{{interviewer_email}}";

    // constructo instantiates a DBTemplates
    public function __construct()
    {
        $this->dbTemplates = new DBTemplates();
    }

    // handles the retrieval of a list of templates by invoking the DBTemplates' listTemplates method
    public function handleList()
    {
        $data = new TemplateListData();
        $data->templates = $this->dbTemplates->listTemplates();
        return $data;
    }

    // handles the creation or editing of a template by invoking either the DBTemplates' createTemplate or editTemplate method
    public function handleCreateOrEdit()
    {
        $data = new TemplateFormData();

        // if user has not posted yet, setup necessary default values
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($data->mode == 'edit') {
                // if editing, get the existing template from the DB
                $template = $this->dbTemplates->getTemplate($data->id);
                $data->contents = $template["contents"];
                $data->title = $template["title"];
                $data->comments = $template["comments"];
            } else {
                // if creating, use the default template
                $data->contents = $this->DEFAULT_TEMPLATE;
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") { // if user has posted

            // extract value of input fields from $_POST
            $data->contents = $_POST['contents'];
            $data->title = $_POST['title'];
            if (isset($_POST['comments'])) {
                $data->comments = $_POST['comments'];
            }

            // validate title
            if (strlen($data->title) < 2) {
                $data->titleValidationError = "Title is not valid";
            }

            // validate contents
            if (strlen($data->contents) < 100) {
                $data->contentsValidationError = "Insufficient contents";
            }

            // validate comments
            if (!$data->comments || count($data->comments) < 1) {
                $data->commentsValidationError = "Add comments to continue";
            }

            // if all fields are valid, then the form is valid
            if (!$data->titleValidationError && !$data->contentsValidationError && !$data->commentsValidationError) {
                $data->valid = true;
            }

            // if the form is valid, the submit button will post a "save", so we can try to save
            if ($data->valid && isset($_POST['save'])) {
                try {
                    if ($data->id && $data->mode == 'edit') {
                        // if there is an id and mode is edit, then try to save using the editTemplate method
                        $this->dbTemplates->editTemplate($data->id, $data->title, $data->contents, $data->comments);
                    } else {
                        // if not, try to create
                        $this->dbTemplates->createTemplate($data->title, $data->contents, $data->comments);
                    }
                    $data->saved = true;
                } catch (Exception $e) {
                    error_log($e);
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        $data->errorSaving = "Template already exists.";
                    } else {
                        $data->errorSaving = "Could not create template.";
                    }
                }
            }

        }

        $data->pageTitle = 'Create a new template';
        if ($data->mode == 'edit') {
            $data->pageTitle = 'Edit a new template';
        }

        return $data;
    }

    // handles the deletion of a template by invoking the DBTemplates' deleteTemplate method
    public function handleDelete()
    {
        $data = new TemplateDeletionData();

        // The template to be deleted
        $template = $this->dbTemplates->getTemplate($data->id);
        $data->contents = $template["contents"];
        $data->title = $template["title"];
        $data->comments = $template["comments"];

        if ($data->confirmed) { // if the user has confirmed, then try to delete
            try {
                $result = $this->dbTemplates->deleteTemplate($data->id);
                $affectedRows = $result->getAffectedRows();
                if ($affectedRows == 1) {
                    $data->deleted = true;
                } else if ($affectedRows == 0) {
                    throw new Exception("No rows deleted");
                } else {
                    throw new Exception("Too many rows deleted ($affectedRows)");
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
                $data->deletionError = "Could not delete. $message";
            }
        }

        return $data;
    }
}
