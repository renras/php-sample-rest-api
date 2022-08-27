<?php
require_once('../config/Database.php');

 class User {
  // create user model with id, name, age, email
  public $id;
  public $name;
  public $age;
  public $email;
  // create a constructor for the user model
  public function __construct($id, $name, $age, $email) {
    // set the properties of the user model
    $this->id = $id;
    $this->name = $name;
    $this->age = $age;
    $this->email = $email;
  }

  // create a function to get all the users
  public static function all() {
    // create an empty array
    $users = [];
    // create a database connection
    $db = new Database();
    // create a query to get all the users
    $sql = "SELECT * FROM users";
    // run the query
    $result = $db->query($sql);
    // if there is a result
    if ($result->num_rows > 0) {
      // loop through the results
      while ($row = $result->fetch_assoc()) {
        // create a new user object
        $user = new User($row['id'], $row['name'], $row['age'], $row['email']);
        // add the user to the array
        $users[] = $user;
      }
    }
    // return the array of users
    return $users;
  }

  // create a function to get a user by id
  public static function find($id) {
    // create a database connection
    $db = new Database();
    // create a query to get the user by id
    $sql = "SELECT * FROM users WHERE id = $id";
    // run the query
    $result = $db->query($sql);
    // if there is a result
    if ($result->num_rows > 0) {
      // get the first row of the result
      $row = $result->fetch_assoc();
      // create a new user object
      $user = new User($row['id'], $row['name'], $row['age'], $row['email']);
      // return the user object
      return $user;
    }
    // return null if there is no user with the id
    return null;
  }

  // create a function to create a new user
  public static function create($name, $age, $email) {
    // create a database connection
    $db = new Database();
    // create a query to create a new user
    $sql = "INSERT INTO users (name, age, email) VALUES ('$name', $age, '$email')";
    // run the query
    $db->query($sql);
    // return the id of the new user
    return $db->the_last_id();
  }

  // create a function to update a user
  public function update($name, $age, $email) {
    // create a database connection
    $db = new Database();
    // create a query to update the user
    $sql = "UPDATE users SET name = '$name', age = $age, email = '$email' WHERE id = $this->id";
    // run the query
    $db->query($sql);
  }

  // create a function to delete a user
  public function delete() {
    // create a database connection
    $db = new Database();
    // create a query to delete the user
    $sql = "DELETE FROM users WHERE id = $this->id";
    // run the query
    $db->query($sql);
  }
 }