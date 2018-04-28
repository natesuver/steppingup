<?php
require 'vendor/autoload.php';
	function getConnection(){
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

	function insertOneResult($query){
		$collection = getConnection();
		$result = $collection->insertOne($query);
		return $result;
	}

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }

    function searchUsers($text) {
		$collection = getConnection();
		$likeText = new MongoRegex("/".$text."/i");
		$user = $collection->findOne(array('$or' => array(
			array('username' => $likeText),array(
		'	fname' => $likeText),array('lname' => $likeText))), array('username' => 1, 'fName' => 1, 'lName' => 1, 'address' => 1));
        return $user;
    }

    function validateLogin($username, $password) {
		$collection = getConnection();
		$query = $collection->findOne(array('username' => $username), array('password'=> 1, 'admin'=> 1));
        if (empty($query)) {
            return array(
                "isValid"=> false,
                "message"=> "Invalid username"
                );
        }
        if(password_verify($password,$query['password'])) {
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
		$collection = getConnection();
		$query = $collection->findOne(array('username' => $username), array('username'=> 1,'fName'=> 1,'lName'=> 1, 'address'=> 1, 'city'=> 1, 'state'=> 1, 'pCode'=> 1, 'gender'=>1, 'birthDate'=> 1, 'height'=> 1, 'weight'=> 1, 'occupation'=> 1));
		return $query;
    }

    function getHeartrateTelemetry() {
		$collection = getConnection();
		$query = $collection->find(array(),array('heartrates.activityDate'=>1,'heartrates.heartRate'=>1))->sort(array('heartrates.activityDate' => -1))->limit(15);
		return $query;
    }

    function getStepTelemetry() {
		$collection = getConnection();
		$query = $collection->find(array(),array('steps.startDate'=>1,'steps.stepsTaken'=>1))->sort(array('steps.startDate' => -1))->limit(15);
		return $query;
    }
    function getDeviceHeartrateTelemetry() {
		$collection = getConnection();
		$query = $collection->find(array('username' => $_SESSION['username']),array('heartrates.activityDate'=>1,'heartrates.heartRate'=>1))->sort(array('heartrates.activityDate' => -1))->limit(15);
		return $query;
    }
    function getDeviceStepTelemetry() {
		$collection = getConnection();
		$query = $collection->find(array('username' => $_SESSION['username']),array('steps.startDate'=>1,'steps.stepsTaken'=>1))->sort(array('steps.startDate' => -1))->limit(15);
		return $query;
    }

    function redirect() {
        if (!isset($_SESSION['username'])){
            header( 'Location: login.php' );
            return;
        }
	}

    function validateNewUsername($value1) {
		$collection = getConnection();
		$query = $collection->find(array('username'=>$value1));
		if (count($query->toArray()) > 0){
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

	function updateDemographics($user, $demographics){
		$collection = getConnection();
		$result = $collection->update(array('username' => $user), $demographics);
		return $result; 
	}

?>