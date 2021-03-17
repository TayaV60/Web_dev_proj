<?php

include 'db/Templates.php';

class FeedbackCoordinator
{
    public function __construct()
    {
        $this->dbTemplates = new DBTemplates();
    }

    public function listTemplates()
    {
        return $this->dbTemplates->listTemplates();
    }

    public function getTemplate($id)
    {
        return $this->dbTemplates->getTemplate($id);
    }

}
