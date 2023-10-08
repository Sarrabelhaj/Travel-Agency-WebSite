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
$phone = $_POST["T3"];
$number_guest = $_POST["T4"];
$number_children = $_POST["T5"];
$date_check_in = $_POST["checkin"];
$date_check_out = $_POST["checkout"];
$country = $_POST["D1"];
$message = $_POST["message"];

//effectuer une resevation
$req1 = $conn->prepare
("INSERT INTO reservation VALUES ('$full_name','$email_address', '$phone', 
'$number_guest', '$number_children', '$date_check_in', '$date_check_out', '$country', '$message')");
$req1->execute();
 if ($req1->affected_rows > 0) {
    echo ' <p align="center"><font face="Bahnschrift" size="5" color="#33CC33"><b>Your 
    Booking has been confirmed.</b></font></p>
    <p align="center">&nbsp;</p>
    <p align="center"><font face="Bahnschrift" size="5">Check your email for details 
    !</font></p>
    <p align="center">&nbsp;</p>
    <p align="center"><a href="../index.html">
    <img border="0" src="yes.png" width="225" height="225"></a></p>';
  }
  else {
    echo 'Reservation Failed!';
  }

$conn->close();
?>