<?php

require_once 'coordination/Supporting_functions.php';

/*
An abstract base class for create or edit form handling
properties defined here model the state of the form, rather
than the data itself. Subclasses add properties of their own
for the specific forms that will use them.
 */
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

    /*
    constructor determines whether the mode is 'edit' or 'create'
    based on the presence or absence of an id query parameter and
    sets this on the $this->mode property
     */
    public function __construct()
    {
        $this->id = getQueryParameter('id');
        $this->mode = $this->getMode($this->id);
    }

    // returns 'edit' if the id is not null, othewrise returns 'create'
    private function getMode($id)
    {
        $mode = 'create';
        if ($id != null) {
            $mode = 'edit';
        }
        return $mode;
    }
}

/*
Similar to the FormData class, this is an abstract base class for modeling
the state of a deletion page (whether the user has confirmed, whether the
deletion has been successfully carried out, etc.). Like with FormData, data
specific to the thing being deleted is added as properties to the concrete
subclasses for use in the deletion views.
 */
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
