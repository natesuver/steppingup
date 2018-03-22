
<?php

/*
This will need to be connected to 
the demographics html page:
<form action="" method="POST">
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SteppingUp";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else {
	echo "Successfully connected";
}


$value1 = $_POST["username"];
$value2 = $_POST["password"];
$value3 = $_POST["fName"];
$value4 = $_POST["lName"]; 
$value5 = $_POST["address"]; 
$value6 = $_POST["city"];
$value7 = $_POST["state"];
$value8 = $_POST["pCode"]; 
$value9 = $_POST["gender"]; 
$value10 = $_POST["birthDate"];
$value11 = $_POST["height"];
$value12 = $_POST["weight"]; 
$value13 = $_POST["occupation"]; 


//send username and demographics information to database
$sql = "insert into user values ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9', '$value10', '$value11', '$value12', '$value13')";
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
