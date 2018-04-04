<?php
    function getConnection() {
		$conn = new mysqli("localhost", "root","","steppingup");
		if ($conn->connect_errno) {
            printf("Connection failed: %s\n", $conn->connect_error);
            exit();
            }
        return $conn;
    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
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

    function runReport($rptId, $from, $to) {
       
        switch ($rptId) {
            case 0: //Average Heart Rate Per Day/City
                $sql = "SELECT avg(heartRate) as 'Avg Heart Rate', DATE(activityDate) 'Activity Date', city as City
                from heartrates
                INNER JOIN users
                 on users.username = heartrates.username
                 WHERE city is not null and activityDate BETWEEN '".$from."' and '".$to."'
                 Group By 'Activity Date', city
                 order by city";
                break;
            case 1: //Total Number of Steps Per Day/Gender/Age
                $sql = "SELECT 
                sum(stepsTaken) as 'Steps', 
                DATE(startDate) as 'Activity Date', 
                gender as Gender,
                YEAR(CURRENT_TIMESTAMP) - YEAR(birthDate) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(birthDate, 5)) as Age
                                from steps
                                INNER JOIN users
                                 on users.username = steps.username
                                 WHERE gender is not null and startDate BETWEEN '".$from."' and '".$to."' and YEAR(CURRENT_TIMESTAMP) - YEAR(birthDate) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(birthDate, 5)) < 100
                                 Group By 'Activity Date', gender, Age
                                 order by 'Activity Date', Age";
                break;
            case 2: //Total Steps Per Day/Occupation
                $sql = "SELECT 
                sum(stepsTaken) as 'Steps', 
                DATE(startDate) as 'Activity Date', 
                occupation as Occupation
                                from steps
                                INNER JOIN users
                                 on users.username = steps.username
                                 WHERE occupation is not null and startDate BETWEEN '".$from."' and '".$to."'
                                 Group By 'Activity Date', occupation
                                 order by 'Activity Date', occupation";
                break;
            case 3: //Total Steps Per User/Year
                $sql = "SELECT 
                sum(stepsTaken) as 'Steps', 
                YEAR(startDate) as 'Activity Year', 
                users.username as 'User Name',
                users.address as 'Address',
                users.city as 'City',
                users.state as 'State',
                users.occupation as 'Occupation'
                                from steps
                                INNER JOIN users
                                 on users.username = steps.username
                                 WHERE startDate BETWEEN '".$from."' and '".$to."'
                                 Group By YEAR(startDate), users.username, users.address, users.city, users.state, users.occupation
                                 order by YEAR(startDate), users.username";
                break;
        }
        
        return execResults($sql);
    }
