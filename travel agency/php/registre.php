<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

$conn = new mysqli($host, $username, $password, $dbname);

//vérifier la connection avec bd
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données depuis le formulaire
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


$stmt = $conn->prepare("SELECT email_address, password FROM client WHERE
 (email_address ='$email_address' AND password = '$password' ) 
OR (email_address='$email_address' ) "    );
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 0) {
  echo 'Username or email already exists';
  die();
} else {
  
$stmt = $conn->prepare("INSERT INTO client VALUES ('$email_address', '$full_name', '$password', '$birth_date', '$gender', '$adr1', '$adr2', '$country', '$city', '$region', '$postal_code')");
$stmt->execute();

  if ($stmt->affected_rows > 0) {
    echo ' <p align="center">&nbsp;</p>
    <p align="center"><a href="../index.html">
    <img border="0" src="yes.png" width="225" height="225"></a></p>
    <p align="center"><b><font face="Bahnschrift" size="6">Thank</font><font face="Bahnschrift" size="6"> 
    You !</font></b></p>
    <p align="center"><font size="5" face="Bahnschrift">Your registration was 
    successful </font></p> ';
  }
}

$conn->close();
?>