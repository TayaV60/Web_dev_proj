<?php

require_once 'coordination/FormData.php';
require_once 'coordination/Supporting_functions.php';
require_once 'db/Roles.php';

// Extends FormData to add role-specific fields
class RoleFormData extends FormData
{
    // POST input field variables
    public $title = null;

    // form state variables
    public $titleValidationError = null;
}

// Extends DeletionData to include the role title
class RoleDeletionData extends DeletionData
{
    public $title = null;
}

// Contains a list of roles
class RoleListData
{
    public $roles;
}

// a handler class for the Role pages
class RoleFormHandler
{
    // constructor instantiates a DBRoles
    public function __construct()
    {
        $this->dbRoles = new DBRoles();
    }

    // handles the retrieval of a list of roles by invoking the DBRoles' listRoles method
    public function handleList()
    {
        $data = new RoleListData();
        $data->roles = $this->dbRoles->listRoles();
        return $data;
    }

    // handles the creation or editing of a role by invoking either the DBRoles' createRole or editRole method
    public function handleCreateOrEdit()
    {
        $data = new RoleFormData();

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($data->mode == 'edit') {
                $role = $this->dbRoles->getRole($data->id);
                $data->title = $role["title"];
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data->title = $_POST['title'];
            if (strlen($data->title) < 4) {
                $data->titleValidationError = "Title is too short";
            }
            if (!$data->titleValidationError) {
                $data->valid = true;
            }
        }

        if ($data->valid && isset($_POST['save'])) {
            try {
                if ($data->id && $data->mode == 'edit') {
                    $this->dbRoles->editRole($data->id, $data->title);
                } else {
                    $this->dbRoles->createRole($data->title);
                }
                $data->saved = true;
            } catch (Exception $e) {
                error_log($e);
                if ($e->errorInfo[1] == 1062) {
                    // duplicate entry
                    $data->errorSaving = "Role already exists.";
                } else {
                    $data->errorSaving = "Could not create role.";
                }
            }
        }

        $data->pageTitle = 'Create a new role';
        if ($data->mode == 'edit') {
            $data->pageTitle = 'Edit a role';
        }

        return $data;
    }

    // handles the deletion of a role by invoking the DBRoles' deleteRole method
    public function handleDelete()
    {
        $data = new RoleDeletionData();

        $role = $this->dbRoles->getRole($data->id);
        $data->title = $role["title"];

        if ($data->confirmed) {
            try {
                $result = $this->dbRoles->deleteRole($data->id);
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
}
