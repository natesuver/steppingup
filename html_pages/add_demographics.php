<?php

/*
This will need to be connected to 
the demographics html page:
<form action="" method="POST">
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Stepping_Up";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else {
	echo "Successfully connected";
}

$value1 = $_POST["fName"];
$value2 = $_POST["lName"]; 
$value3 = $_POST["address"]; 
$value4 = $_POST["city"];
$value5 = $_POST["state"];
$value6 = $_POST["pCode"]; 
$value7 = $_POST["gender"]; 
$value8 = $_POST["birthDate"];
$value9 = $_POST["height"];
$value10 = $_POST["weight"]; 
$value11 = $_POST["occupation"]; 


//run query and send data to database
$sql = "insert into demographics values ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9', '$value10', '$value11')";
if ($conn->query($sql) === TRUE) {
	echo "<br/>";
	echo "Insertion successful";
} else {
	echo "<br/>";
	echo "Error accessing database: " . $conn->error; 
}
//terminate connection
$conn->close();
?>
