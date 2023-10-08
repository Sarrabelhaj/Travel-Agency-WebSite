<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "bdtravel";

// Create a new MySQLi object and connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get user data submitted through an HTML form and assign them to variables
$full_name = $_POST["T1"];
$email_address = $_POST["T2"];
$password = $_POST["T3"];
$birth_date = $_POST["Date"];
$gender = $_POST["R1"];
$adr1 = $_POST["T4"];
$adr2 = $_POST["T5"];
$country = $_POST["D1"];
$city = $_POST["T6"];
$region = $_POST["T7"];
$postal_code = $_POST["T8"];

// Prepare the SELECT query to check if the user already exists
$stmt = $conn->prepare("SELECT email_address, password FROM client WHERE email_address = ? AND password = ?");
$stmt->bind_param("ss", $email_address, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if there is already a user with the same email and password
if ($result->num_rows != 0) {
  echo 'Username or email already exists';
  die();
} else {
  // Prepare the INSERT query to add the user's information to the database
  $stmt = $conn->prepare("INSERT INTO client (email_address, full_name, password, birth_date, gender, adr1, adr2, country, city, region, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssssss", $email_address, $full_name, $password, $birth_date, $gender, $adr1, $adr2, $country, $city, $region, $postal_code);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    echo 'Registration successful!';
  }
}

// Close the database connection
$conn->close();

?>