<?php
include_once 'db_connection.php';

class DBTemplates extends DB
{

    public function listTemplates()
    {
        $query = "SELECT id, title FROM Templates";
        $dbResult = $this->query($query);
        return $dbResult->getResult();
    }

    public function getTemplate($id)
    {
        $query = "SELECT * FROM Templates WHERE id = :id ";
        $params = array(":id" => $id);
        $dbResult = $this->query($query, $params);
        $templateArray = $dbResult->getResult();
        return $templateArray[0];
    }

    public function createTemplate($title, $contents, $comments)
    {
        $commentsJoined = implode("::::", $comments);
        $query = 'INSERT INTO Templates (title, contents, comments) VALUES (:title, :contents, :commentsJoined)';
        $params = array(
            ":title" => $title,
            ":contents" => $contents,
            ":commentsJoined" => $commentsJoined,
        );
        return $this->query($query, $params);
    }

    public function editTemplate($id, $title, $contents, $comments)
    {
        $commentsJoined = implode("::::", $comments);
        $query = 'UPDATE Templates SET title = :title, contents = :contents, comments = :commentsJoined WHERE id = :id';
        $params = array(
            ":title" => $title,
            ":contents" => $contents,
            ":commentsJoined" => $commentsJoined,
            ":id" => $id,
        );
        return $this->query($query, $params);
    }

    public function deleteTemplate($id)
    {
        $query = 'DELETE FROM Templates WHERE id = :id';
        $params = array(":id" => $id);
        return $this->query($query, $params);
    }

}
