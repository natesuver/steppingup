<?php session_start(); 
require 'functions.php';


$newUserError = '';
if (isset($_POST['submit']) && isset($_POST['username']) && !empty($_POST['username'])) {
	$newUserResult = validateNewUsername($_POST['username']);
	$newUserError = $newUserResult['message'];
	if ($newUserResult['isValid']==1){
		$_SESSION['username'] = $_POST['username'];
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
		$sql = "INSERT INTO users (username, password, fName, lName, address, city, state, pCode, gender, birthDate, height, weight, occupation, admin) 
		VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9', '$value10', '$value11', '$value12', '$value13',0);";
		if (execNoResult($sql) === TRUE) {
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['admin'] = 0;
			header( 'Location: user-lobby.php' );
		} else {
			echo "<br/>";
			echo "Error accessing database: " . $conn->error; 
		}
	}
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Register</title>
</head>
<body>
<div class="panel panel-info user-demographics-box">
    <div class="panel-heading">
        <h3 class="panel-title">Create New User</h3>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="panel-body">
        <div class="input-group">
            <label for="login_username">Username:</span>
            <input class="form-control" id="login_username" type='text' name='username' required><span class="newUserError" style="color: red;"><?php echo $newUserError; ?></span>
        </div>
        <div class="input-group">
            <label for="login_pword">Password:</span>
            <input class="form-control" id="login_pword" type='password' name='password' required>
        </div>
        <div class="input-group">
            <label for="login_pword2">Confirm Password:</span>
            <input class="form-control" id="login_pword2" type='password' name='password_confirm' required>
			<br />
			<div class="row text-center" id="password_check">
            </div>
        </div>
        <div class="input-group">
            <label for="demo_fName">First Name:</span>
            <input class="form-control" id="demo_fName" type='text' name='fName' required>
        </div>
        <div class="input-group">
            <label for="demo_lName">Last Name:</span>
            <input class="form-control" id="demo_lName" type='text' name='lName'>
        </div>
        <div class="input-group">
            <label for="demo_address">Address:</span>
            <input class="form-control" id="demo_address" type='text' name='address'>
        </div>
        <div class="input-group">
            <label for="demo_city">City:</span>
            <input class="form-control" id="demo_city" type='text' name='city'>
        </div>
        <div class="input-group">
            <label for="demo_state">State:</span>
            <select class="form-control" id="demo_state" type='text' name='state' required>
                <option value="">Select One</option>
                <option>Alabama </option>
                <option>Alaska</option>
                <option>Arizona</option>
                <option>Arkansas </option>
                <option>California </option>
                <option>Colorado</option>
                <option>Connecticut</option>
                <option>Delaware</option>
                <option>Florida</option>
                <option>Georgia</option>
                <option>Hawaii</option>
                <option>Idaho</option>
                <option>Illinois</option>
                <option>Indiana</option>
                <option>Iowa</option>
                <option>Kansas</option>
                <option>Kentucky</option>
                <option>Louisiana</option>
                <option>Maine</option>
                <option>Maryland</option>
                <option>Massachusetts</option>
                <option>Michigan</option>
                <option>Minnesota</option>
                <option>Mississippi</option>
                <option>Missouri</option>
                <option>Montana</option>
                <option>Nebraska</option>
                <option>Nevada</option>
                <option>New Hampshire</option>
                <option>New Jersey</option>
                <option>New Mexico</option>
                <option>New York</option>
                <option>North Carolina</option>
                <option>North Dakota</option>
                <option>Ohio</option>
                <option>Oklahoma</option>
                <option>Oregon</option>
                <option>Pennsylvania</option>
                <option>Rhode Island</option>
                <option>South Carolina</option>
                <option>South Dakota</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Utah</option>
                <option>Vermont</option>
                <option>Virginia</option>
                <option>Washington</option>
                <option>West Virginia</option>
                <option>Wisconsin</option>
                <option>Wyoming</option>
            </select>
        </div>
        <div class="input-group">
            <label for="demo_pCode">Postal Code:</span>
            <input class="form-control" id="demo_pCode" type='text' name='pCode'>
        </div>
        <div class="input-group">
            <label for="demo_gender">Gender:</span>
            <select class="form-control" id="demo_gender" type='text' name='gender' required>
                <option value="">Select One</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>
        <div class="input-group">
            <label for="demo_bDay">Birth Date:</span>
            <input class="form-control" id="demo_bDay" type='date' name='birthDate' required>
        </div>
        <div class="input-group">
            <label for="demo_height">Height (in):</span>
            <input class="form-control" id="demo_height" type='text' name='height'>
        </div>
        <div class="input-group">
            <label for="demo_weight">Weight (lbs):</span>
            <input class="form-control" id="demo_weight" type='text' name='weight'>
        </div>
        <div class="input-group">
            <label for="demo_occupation">Occupation:</span>
            <input id="demo_occupation" type='text' name='occupation' required>
        </div>
        <br>
        <input id="enter" type='submit' value="Sign Up" name='submit'>
        <input id="cancel" type="submit" value="Cancel" name="cancel" />
    </form>
</div>
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
        </div>
    </div>
    <div id="login_form_wrapper" >
        <div class="row ">
                <div class="row">
                    <div class="col-md-12">
                        : 
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        :  
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        :   
                    </div>
                </div>
                <br />
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            : 
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 10px">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <img id="logo" src="<?php if($_SESSION['useMongo']==0) { echo "https://www.mysql.com/common/logos/logo-mysql-170x115.png";} else {echo "https://zdnet3.cbsistatic.com/hub/i/r/2018/02/16/8abdb3e1-47bc-446e-9871-c4e11a46f680/resize/370xauto/8a68280fd20eebfa7789cdaa6fb5eff1/mongo-db-logo.png";} ?>" class="db-logo"></img>

</body>
</html>
<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="validatePassword.js"></script>
