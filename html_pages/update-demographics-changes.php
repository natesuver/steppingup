<?php session_start();
//require 'functions.php';
require 'noSql-functions.php';//nosql

$currentUser = $_SESSION['username'];

$value3 = $_POST["fName"];
$value4 = $_POST["lName"]; 
$value5 = $_POST["address"]; 
$value6 = $_POST["city"];
$value7 = $_POST["state"];
$value8 = $_POST["pCode"]; 
$value9 = $_POST["gender"]; 
$value11 = $_POST["height"];
$value12 = $_POST["weight"]; 
$value13 = $_POST["occupation"]; 

//update demographics information to database
/*$sql = "UPDATE users SET fName='$value3', lName='$value4', address='$value5', city='$value6', 
state='$value7', pCode='$value8', gender='$value9', height=$value11, weight=$value12, occupation='$value13'
WHERE username='$currentUser';";*/
$demographics = array('$set' => array('fName' => $value3, 'lName' =>$value4, 'address'=> $value5, 'city'=> $value6, 'state'=> $value7, 'pCode'=>$value7, 'gender'=>$value8, 'height'=>$value11, 'weight'=>$value12, 'occupation'=>$value13 ));//nosql
updateDemographics($currentUser, $demographics);//noSql

if (execNoResult($sql) === TRUE) {
	header( 'Location: user-lobby.php' );
} else {
	echo "<br/>";
	echo "Error accessing database: " . $conn->error; 
}
?>
