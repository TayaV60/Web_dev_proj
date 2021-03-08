<?php
// opens the connection to the database
function OpenCon() {
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $db = "HappyTech";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
  return $conn;
}

// closes the connection with the database
function CloseCon($conn) {
  $conn -> close();
}

class DB {
  protected $conn;

  public function __construct() {
      $this->conn = OpenCon();
  }

  public function __destruct() {
    CloseCon($this->conn);
  }

  /*
   * Runs a query. $query is always required. $types and $params can be supplied to bind query parameters.
   */
  protected function query($query, $types = "", $params = []) {

    $stmt = $this->conn->prepare($query);
    if ( false === $stmt ) {
      error_log('mysqli prepare() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
      throw new Exception('Prepare failed');
    }

    if ($params) {
      $bind = $stmt->bind_param($types, ...$params);
      if ( false === $bind ) {
        error_log('bind_param() failed:');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
        throw new Exception('Bind parameters failed');
      }
    }

    $exec = $stmt->execute();
    if ( false === $exec ) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
      throw new Exception("Execution failed $stmt->error");
    }

    $dbResult = new DBStatementResults($stmt);

    error_log(print_r($dbResult->getAffectedRows(), true));
    error_log(print_r($dbResult->getResult(), true));
    
    $stmt->close();

    return $dbResult;
  }
}

/*
 * Keeps the statement result and the number of affected rows.
 */
class DBStatementResults {
  // The result from $stmt->get_result()
  private $result;

  // The result from $stmt->affected_rows
  private $affectedRows;

  public function __construct($stmt) {
    $this->result = $stmt->get_result();
    $this->affectedRows = $stmt->affected_rows;
  }

  public function getResult() {
    return $this->result;
  }

  public function getAffectedRows() {
    return $this->affectedRows;
  }
}
