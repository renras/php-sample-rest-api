<?php

// require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once('../models/users.php');
require_once('../config/Database.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
  // create a database connection
  $db = new Database();
  // create a query to get the user by id
  $sql = "SELECT * FROM users WHERE id = {$_GET['id']}";
  // run the query
  $result = $db->query($sql);
  // if there is a result
  if ($result->num_rows > 0) {
    // get the first row of the result
    $row = $result->fetch_assoc();
    // create a new user object
    $user = new User($row['id'], $row['name'], $row['age'], $row['email']);
    // return the user object
    echo json_encode($user);
  }

  return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
  echo json_encode($users);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the post data
  $data = json_decode(file_get_contents("php://input"));
  // create a database connection
  $db = new Database();
  // create a query to insert the user
  $sql = "INSERT INTO users (name, age, email) VALUES ('{$data->name}', {$data->age}, '{$data->email}')";
  // run the query
  $result = $db->query($sql);
  // if there is a result
  if ($result) {
    // create a new user object
    $user = new User($db->conn->insert_id, $data->name, $data->age, $data->email);
    // return the user object
    echo json_encode($user);
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  // get the post data
  $data = json_decode(file_get_contents("php://input"));
  // create a database connection
  $db = new Database();
  // create a query to update the user
  $sql = "UPDATE users SET name = '{$data->name}', age = {$data->age}, email = '{$data->email}' WHERE id = {$data->id}";
  // run the query
  $result = $db->query($sql);
  // if there is a result
  if ($result) {
    // create a new user object
    $user = new User($data->id, $data->name, $data->age, $data->email);
    // return the user object
    echo json_encode($user);
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  // get the post data
  $data = json_decode(file_get_contents("php://input"));
  // create a database connection
  $db = new Database();
  // create a query to delete the user
  $sql = "DELETE FROM users WHERE id = {$data->id}";
  // run the query
  $result = $db->query($sql);
  // if there is a result
  if ($result) {
    // return the user object
    echo json_encode($data);
  }
}








