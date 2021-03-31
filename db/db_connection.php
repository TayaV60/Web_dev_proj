<?php

/*
 * A base class that constructs a PDO connection and provides a method for executing SQL queries.
 */
abstract class DB
{
    private $conn;

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
     * Runs a query. The $query string is always required. A $params associative array
     * can be supplied to bind query parameters. Exceptions will be thrown if the
     * statement cannot be prepared, params cannot be bound, or the statement cannot
     * be executed. It is up to the caller (usually a handler class), to catch these
     * exceptions and deal with them appropriately.
     */
    protected function query($query, $params = [])
    {
        // prepare a statement with the $query
        $stmt = $this->conn->prepare($query);
        if (false === $stmt) {
            error_log('PDO prepare() failed: ');
            error_log(print_r(htmlspecialchars($stmt->error), true));
            throw new Exception('Prepare failed');
        }

        // bind params
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

        // execute statement
        $exec = $stmt->execute();
        if (false === $exec) {
            error_log('PDO execute() failed: ');
            error_log(print_r(htmlspecialchars($stmt->error), true));
            throw new Exception("Execution failed $stmt->error");
        }

        // extract statement results into a DBStatementResults object
        $dbResult = new DBStatementResults($stmt);

        // once results extracted, close the statement
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
