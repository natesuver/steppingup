<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "steppingup";

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
$value2 = password_hash($_POST["password"], PASSWORD_DEFAULT);
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
$value14 = $_POST[""];

//send username and demographics information to database
$sql = "insert into users values ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9', '$value10', '$value11', '$value12', '$value13', '$value14')";
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
