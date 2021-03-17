<?php

// returns 'edit' if the id is not null, othewrise returns 'create'
function getMode($id)
{
    $mode = 'create';
    if ($id != null) {
        $mode = 'edit';
    }
    return $mode;
}

//retrieves a $_GET parameter, returning null and not causing a warning if not present
function getQueryParameter($key)
{
    $value = null;
    if (isset($_GET[$key])) {
        $value = $_GET[$key];
    }
    return $value;
}

//retrieves a $_POST parameter, returning null and not causing a warning if not present
function getPostParameter($key)
{
    $value = null;
    if (isset($_POST[$key])) {
        $value = $_POST[$key];
    }
    return $value;
}
