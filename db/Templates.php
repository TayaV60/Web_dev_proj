<?php
require_once 'db_connection.php';

// extends DB to provide methods that query the Templates table
class DBTemplates extends DB
{
    private $commentSeparator = "::::";

    // returns a list of templates
    public function listTemplates()
    {
        $query = "SELECT * FROM Templates";
        $dbResult = $this->query($query);
        $templates = $dbResult->getResult();
        foreach ($templates as $template) {
            $template["comments"] = $this->commentsStringToArray($template["comments"]);
        }
        return $templates;
    }

    // returns a template matching the provided $id
    public function getTemplate($id)
    {
        $query = "SELECT * FROM Templates WHERE id = :id ";
        $params = array(":id" => $id);
        $dbResult = $this->query($query, $params);
        $templateArray = $dbResult->getResult();
        $template = $templateArray[0];
        $template["comments"] = $this->commentsStringToArray($template["comments"]);
        return $template;
    }

    // creates a template
    public function createTemplate($title, $contents, $comments)
    {
        $commentsJoined = $this->commentsArrayToString($comments);
        $query = 'INSERT INTO Templates (title, contents, comments) VALUES (:title, :contents, :comments)';
        $params = array(
            ":title" => $title,
            ":contents" => $contents,
            ":comments" => $commentsJoined,
        );
        return $this->query($query, $params);
    }

    // edits the template
    public function editTemplate($id, $title, $contents, $comments)
    {
        $commentsJoined = $this->commentsArrayToString($comments);
        $query = 'UPDATE Templates SET title = :title, contents = :contents, comments = :comments WHERE id = :id';
        $params = array(
            ":title" => $title,
            ":contents" => $contents,
            ":comments" => $commentsJoined,
            ":id" => $id,
        );
        return $this->query($query, $params);
    }

    // deletes the template
    public function deleteTemplate($id)
    {
        $query = 'DELETE FROM Templates WHERE id = :id';
        $params = array(":id" => $id);
        return $this->query($query, $params);
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
