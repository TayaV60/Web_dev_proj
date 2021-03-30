<?php

require_once 'coordination/Supporting_functions.php';

abstract class FormData
{
    // The id of the object within the database
    public $id = null;

    // Can be either "create" or "edit"
    public $mode = null;

    // Is the form in a valid state or not
    public $valid = false;

    // Whether the object has just been saved by the user
    public $saved = false;

    // Whether the save encountered an error
    public $errorSaving = null;

    public function __construct()
    {
        $this->id = getQueryParameter('id');
        $this->mode = getMode($this->id);
    }
}

abstract class DeletionData
{
    // The id of the object within the database
    public $id = null;

    // Whether the user has confirmed deletion
    public $confirmed = null;

    // Has the object been deleted
    public $deleted = false;

    // Was there an error deleting
    public $deletionError = null;

    public function __construct()
    {
        $this->id = getQueryParameter('id');
        $this->confirmed = getQueryParameter('confirmed');
    }
}
