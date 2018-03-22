<?php
    function getConnection() {
		$conn = new mysqli("localhost", "root","","steppingup");
		if ($conn->connect_errno) {
            printf("Connection failed: %s\n", $conn->connect_error);
            exit();
            }
        return $conn;
    }

    function execResults($sql) {
        $conn = getConnection();
        $data = array();
        $result = $conn->query($sql);

        while($row =$result->fetch_assoc()) {
        array_push($data, $row);
        }
        $conn->close();
        return $data;
    }

    function searchUsers($text) {
        $sql = "Select username, fName, lName, address from users where username like '%".$text."%' or fname like '%".$text."%'  or lname like '%".$text."%'";
        return execResults($sql);
    }
