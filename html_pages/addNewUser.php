<?php session_start();
require 'functions.php';
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

//send username and demographics information to database
$sql = "INSERT INTO users (username, password, fName, lName, address, city, state, pCode, gender, birthDate, height, weight, occupation, admin) 
	VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9', '$value10', $value11, $value12, '$value13',0)";

if (execNoResult($sql) === TRUE) {
	$_SESSION['username'] = $_POST['username'];
    $_SESSION['admin'] = 0;
	header( 'Location: admin-lobby.php' );
} else {
	echo "<br/>";
	echo "Error accessing database: " . $conn->error; 
}

?>
