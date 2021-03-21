<?php
include_once 'db_connection.php';

class DBTemplates extends DB
{

    public function listTemplates()
    {
        $query = "SELECT * FROM Templates";
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
        $query = 'INSERT INTO Templates (title, contents, comments) VALUES (:title, :contents, :comments)';
        $params = array(
            ":title" => $title,
            ":contents" => $contents,
            ":comments" => $comments,
        );
        return $this->query($query, $params);
    }

    public function editTemplate($id, $title, $contents, $comments)
    {
        $query = 'UPDATE Templates SET title = :title, contents = :contents, comments = :comments WHERE id = :id';
        $params = array(
            ":title" => $title,
            ":contents" => $contents,
            ":comments" => $comments,
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
