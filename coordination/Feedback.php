<?php

require_once 'db/Templates.php';
require_once 'db/Users.php';

class FeedbackCoordinator
{
    private $commentSeparator = "::::";

    public function __construct()
    {
        $this->dbTemplates = new DBTemplates();
        $this->dbUsers = new DBUsers();
    }

    public function listTemplates()
    {
        $templates = $this->dbTemplates->listTemplates();
        foreach ($templates as $template) {
            $template["comments"] = $this->commentsStringToArray($template["comments"]);
        }
        return $templates;
    }

    public function getTemplate($id)
    {
        $template = $this->dbTemplates->getTemplate($id);
        $template["comments"] = $this->commentsStringToArray($template["comments"]);
        return $template;
    }

    public function createTemplate($title, $contents, $comments)
    {
        $commentsJoined = $this->commentsArrayToString($comments);
        return $this->dbTemplates->createTemplate($title, $contents, $commentsJoined);
    }

    public function editTemplate($id, $title, $contents, $comments)
    {
        $commentsJoined = $this->commentsArrayToString($comments);
        return $this->dbTemplates->editTemplate($id, $title, $contents, $commentsJoined);
    }

    public function deleteTemplate($id)
    {
        return $this->dbTemplates->deleteTemplate($id);
    }

    public function getUserByUsername($username)
    {
        return $this->dbUsers->getUserByUsername($username);
    }

    private function commentsStringToArray($commentsString)
    {
        return explode($this->commentSeparator, $commentsString);
    }

    private function commentsArrayToString($commentsArray)
    {
        return implode($this->commentSeparator, $commentsArray);
    }

}
