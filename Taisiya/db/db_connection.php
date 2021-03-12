<?php

class DB
{
    protected $conn;

    public function __construct()
    {
        try {
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $db = "HappyTech";
            $this->conn = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Open connection failed: ');
            error_log(print_r(htmlspecialchars($e), true));
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    /*
     * Runs a query. $query is always required. $types and $params can be supplied to bind query parameters.
     */
    protected function query($query, $params = [])
    {

        $stmt = $this->conn->prepare($query);
        if (false === $stmt) {
            error_log('PDO prepare() failed: ');
            error_log(print_r(htmlspecialchars($stmt->error), true));
            throw new Exception('Prepare failed');
        }

        if ($params) {
            foreach ($params as $key => $value) {
                $bind = $stmt->bindValue($key, $value);
                if (false === $bind) {
                    error_log('bindValue() failed:');
                    error_log(print_r(htmlspecialchars($stmt->error), true));
                    throw new Exception('Bind parameters failed');
                }
            }
        }

        $exec = $stmt->execute();
        if (false === $exec) {
            error_log('PDO execute() failed: ');
            error_log(print_r(htmlspecialchars($stmt->error), true));
            throw new Exception("Execution failed $stmt->error");
        }

        $dbResult = new DBStatementResults($stmt);

        error_log(print_r($dbResult->getAffectedRows(), true));
        error_log(print_r($dbResult->getResult(), true));

        $stmt = null;

        return $dbResult;
    }
}

/*
 * Keeps the statement result and the number of affected rows.
 */
class DBStatementResults
{
    // The result from $stmt->fetchAll()
    private $result;

    // The result from $stmt->rowCount
    private $affectedRows;

    public function __construct($stmt)
    {
        $this->result = $stmt->fetchAll();
        $this->affectedRows = $stmt->rowCount();
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getAffectedRows()
    {
        return $this->affectedRows;
    }
}
