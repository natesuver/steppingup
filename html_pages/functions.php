<?php
    require 'vendor/autoload.php';
    function getConnection() {
		$conn = new mysqli("localhost", "root","","steppingup");
		if ($conn->connect_errno) {
            printf("Connection failed: %s\n", $conn->connect_error);
            exit();
            }
        return $conn;
    }

    function getUsersCollection(){
		try {
			$conn =  new MongoDB\Client();
			$db = $conn->steppingup;
		} 
		catch (MongoConnectionException $e) {            
			printf('Error connecting to MongoDB server');
			exit();
        } 
		catch (MongoException $e) {           
			printf('Error: ' . $e->getMessage());
			exit();
		}
		return $db->users;
	}

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
    function execNoResult($sql) {
        $conn = getConnection();
        $result = $conn->query($sql);
        if ($conn->error) {
        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
        }
        $conn->close();
        return $result;
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
    function execSingleResult($sql) {
        $conn = getConnection();
        $result = $conn->query($sql);
        if (!$result) {
            throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
        }
        $data = $result->fetch_assoc();
        $conn->close();
        return $data;
    }
    function searchUsers($text) {
        if ($_SESSION['useMongo']==0){
            $sql = "Select username, fName, lName, address from users where username like '%".$text."%' or fname like '%".$text."%'  or lname like '%".$text."%'";
            return execResults($sql);
        } else {
            $collection = getUsersCollection();
            $results = $collection->find(array('$or' => array(
                array("username" => ['$regex'=>'^'.$text]),array('fname' => ['$regex'=>'^'.$text]),array('lname' => ['$regex'=>'^'.$text]))), array('username' => 1, 'fName' => 1, 'lName' => 1, 'address' => 1))->toArray();
            return $results;
        }  
    }

    function runReport($rptId, $from, $to) {
        switch ($rptId) {
        case 0: //Average Heart Rate Per Day/City
            if ($_SESSION['useMongo']==0) {
                $sql = "SELECT city as City,avg(heartRate) as 'Avg Heart Rate', DATE(activityDate) 'Activity Date'
                from heartrates
                INNER JOIN users
                on users.username = heartrates.username
                WHERE city is not null and activityDate BETWEEN '".$from."' and '".$to."'
                Group By 'Activity Date', city
                order by city";
                return execResults($sql);
            } else {
                echo "do mongo stuff while playing bongos";
            }  
            break;
        case 1: //Total Number of Steps Per Day/Gender/Age
            if ($_SESSION['useMongo']==0) {
                $sql = "SELECT 
                DATE(startDate) as 'Activity Date', 
                gender as Gender,
                YEAR(CURRENT_TIMESTAMP) - YEAR(birthDate) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(birthDate, 5)) as Age,
                sum(stepsTaken) as 'Steps'
                from steps
                INNER JOIN users
                    on users.username = steps.username
                    WHERE gender is not null and startDate BETWEEN '".$from."' and '".$to."' and YEAR(CURRENT_TIMESTAMP) - YEAR(birthDate) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(birthDate, 5)) < 100
                    Group By 'Activity Date', gender, Age
                    order by 'Activity Date', Age";
                return execResults($sql);
            } else {
                echo "do mongo while playing bongos";
            }
            break;
        case 2: //Total Steps Per Day/Occupation
		    if ($_SESSION['useMongo']==0) {
                $sql = "SELECT 
                DATE(startDate) as 'Activity Date', 
                occupation as Occupation,
                sum(stepsTaken) as 'Steps'
                from steps
                INNER JOIN users
                    on users.username = steps.username
                    WHERE occupation is not null and startDate BETWEEN '".$from."' and '".$to."'
                    Group By 'Activity Date', occupation
                    order by 'Activity Date', occupation";
                return execResults($sql);
            } else {
                echo "do mongo while playing bongos";
            }
            break;
        case 3: //Total Steps Per User/Year
            if ($_SESSION['useMongo']==0) {
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
                return execResults($sql);
            } else {
                echo "do mongo while playing bongos";
            }
            break;
        }
        
        
    }

function validateLogin($username, $password) {
	if ($_SESSION['useMongo']==0) {
        $sql = "Select password, admin from users where username='".$username."'";
        $sqlResult = execSingleResult($sql);
	} else {
        $collection = getUsersCollection();
        $sqlResult = $collection->findOne(array('username' => $username), array('password'=> 1, 'admin'=> 1));
	}
    //TODO: this might give us issues, depending on mongo implementation.
    if (empty($sqlResult)) {
        return array(
            "isValid"=> false,
            "message"=> "Invalid username"
            );
    }
    if(password_verify($password,$sqlResult['password'])) {
        return array(
            "isValid"=> true,
            "message"=> "User Logged In",
            "admin"=> $sqlResult['admin']
            );
    }
    else {
        return array(
            "isValid"=> false,
            "message"=> "Invalid password"
            );
    }
       
}

function getUserInfo($username){
    if ($_SESSION['useMongo']==0) {
    	$sql = "Select username, fName, lName, address, city, state, pCode, gender, birthDate, height, weight, occupation from users where username='".$username."'";
	    return execSingleResult($sql);
	} else {
        $collection = getUsersCollection();
        return $collection->find(['username'=>$username])->toArray();
	}  
}
    
function getHeartrateTelemetry() {
    if ($_SESSION['useMongo']==0) {
        $sql = "Select activityDate, heartRate from heartrates order by activityDate desc LIMIT 15;";
	    return execResults($sql);
	} else {
        $collection = getUsersCollection();
        return $collection->aggregate(
            [
                ['$unwind' => '$heartrates'],
                ['$project' => ['activityDate'=>'$heartrates.activityDate', 'heartRate'=>'$heartrates.heartRate']],
                ['$sort' => ['activityDate' => -1]],
                ['$limit' => 15]
            ]
        )->toArray();
	}  
}
function getStepTelemetry() {
	if ($_SESSION['useMongo']==0){
        $sql = "Select startDate, stepsTaken from steps order by startDate desc LIMIT 15;";
	    return execResults($sql);
	} else {
        $collection = getUsersCollection();
        return $collection->aggregate(
            [
                ['$unwind' => '$steps'],
                ['$project' => ['startDate'=>'$steps.startDate', 'stepsTaken'=>'$steps.stepsTaken']],
                ['$sort' => ['startDate' => -1]],
                ['$limit' => 15]
            ]
        )->toArray();   
	}  
}
    
function getDeviceHeartrateTelemetry() {
	if ($_SESSION['useMongo']==0){
      	$sql = "Select activityDate, heartRate from heartrates WHERE username = '".$_SESSION['username']."' order by activityDate desc LIMIT 15;";
	    return execResults($sql);
	} else {
        $collection = getUsersCollection();
	    $result= $collection->find(array('username' => $_SESSION['username']),[
            'projection' => [
                'heartrates' => ['$slice'=>-15],
                'heartrates.activityDate' => 1,
                'heartrates.heartRate' => 1
            ],
            'sort' => ['heartrates.activityDate' => -1]
        ])->toArray();
        return $result[0]['heartrates'];
    }  
}
function getDeviceStepTelemetry() {
	if ($_SESSION['useMongo']==0){
        $sql = "Select startDate, stepsTaken from steps WHERE username = '".$_SESSION['username']."' order by startDate desc LIMIT 15;";
	    return execResults($sql);
	} else {
        $collection = getUsersCollection();
        $result= $collection->find(array('username' => $_SESSION['username']),[
            'projection' => [
                'steps' => ['$slice'=>-15],
                'steps.startDate' => 1,
                'steps.stepsTaken' => 1
            ],
            'sort' => ['steps.startDate' => -1]
        ])->toArray();
        return $result[0]['steps'];    
	}  
}

    function redirect() {
        if (!isset($_SESSION['username'])){
            header( 'Location: login.php' );
            return;
        }
       
    }

function validateNewUsername($value1) {
	$conn = getConnection();
	if ($_SESSION['useMongo']==0) {
        $sql = "SELECT * FROM users WHERE username='".$value1."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $conn->close();
            return array(
                "isValid"=> false,
                "message"=>"Username is taken!! :-O"
                );
        } else {
            $conn->close();
            return array (
                "isValid"=> true,
                "message"=> "Welcome"
            );
        }
    } else {
        $collection = getUsersCollection();
        $result = $collection->count(array('username'=>$value1));
        if ($result>0) { 
            return array(
                "isValid"=> false,
                "message"=>"Username is taken!! :-O"
                );
        } else {
            return array (
                "isValid"=> true,
                "message"=> "Welcome"
            );
        }
    }  
	
	}
?>
