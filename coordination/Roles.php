<?php

require_once 'coordination/FormData.php';
require_once 'coordination/Supporting_functions.php';
require_once 'db/Roles.php';

class RoleFormData extends FormData
{
    // POST input field variables
    public $title = null;

    // form state variables
    public $titleValidationError = null;
}

class RoleDeletionData extends DeletionData
{
    public $title = null;
}

class RoleListData
{
    public $roles;
}

class RoleFormHandler
{
    public function __construct()
    {
        $this->dbRoles = new DBRoles();
    }

    public function handleList()
    {
        $data = new RoleListData();
        $data->roles = $this->dbRoles->listRoles();
        return $data;
    }

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
                $data->titleValidationError = "Name is too short";
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
