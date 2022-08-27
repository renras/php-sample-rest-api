<?php
  // create a database class
  class Database {
    // create a database connection
    public function __construct() {
      // connect to the database
      $this->connect();
    }
    // create a function to connect to the database
    public function connect() {
      // connect to the database
      $this->conn = new mysqli('localhost', 'root', '', 'api');
    }

    // create a function to query the database
    public function query($sql) {
      // run the query
      return $this->conn->query($sql);
    }
  }
?>

