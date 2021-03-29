<?php

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
}
