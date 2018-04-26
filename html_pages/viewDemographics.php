<?php
session_start();
require 'functions.php';
    if (!isset($_SESSION['username'])) {
        header( 'Location: user-admin.php' );
	}
$conn = getConnection();
$username = $_SESSION['username'];
$sql = "SELECT username, fName, lName, address, city, state, pCode, birthDate, gender, height, weight, occupation
FROM users WHERE username='$username'";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($query);

$username = $_SESSION['username'];
$fName = $user['fName'];
$lName = $user['lName'];
$address = $user['address'];
$city = $user['city'];
$state = $user['state'];
$pCode = $user['pCode'];
$birthDate = $user['birthDate'];
$gender = $user['gender'];
$height = $user['height'];
$weight = $user['weight'];
$occupation = $user['occupation'];

?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Update Demographics</title>
</head>

<body>
<div class="panel panel-info report-search-box">
    <div class="panel-heading">
        <h3 class="panel-title">Create New User</h3>
    </div>
    <form action="user-lobby.php" method="POST" class="panel-body">
        <div class="input-group">
            <label for="login_username">Username:</span>
            <?php echo "<input class='form-control' id='login_username' type='text' name='username' disabled value='$username'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_fName">First Name:</span>
            <?php echo "<input class='form-control' id='demo_fName' type='text' name='fName' disabled value='$fName'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_lName">Last Name:</span>
            <?php echo "<input class='form-control' id='demo_lName' type='text' name='lName' disabled value='$lName'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_address">Address:</span>
            <?php echo "<input class='form-control' id='demo_address' type='text' name='address' disabled value='$address'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_city">City:</span>
            <?php echo "<input class='form-control' id='demo_city' type='text' name='city' disabled value='$city'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_state">State:</span>
			<?php echo "<input class='form-control' id='demo_state' type='text' name='state' disabled value='$state'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_pCode">Postal Code:</span>
            <?php echo "<input class='form-control' id='demo_pCode' type='text' name='pCode' disabled value='$pCode'>" ?>
        </div>
		<div class="input-group">
            <label for="demo_occupation">Occupation:</span>
            <?php echo "<input id='demo_bDate' type='text' name='birthDate' disabled value='$birthDate'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_gender">Gender:</span>
			<?php echo "<input class='form-control' id='demo_gender' type='text' name='gender' disabled value='$gender'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_height">Height (in):</span>
            <?php echo "<input class='form-control' id='demo_height' type='text' name='height' disabled value='$height'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_weight">Weight (lbs):</span>
            <?php echo "<input class='form-control' id='demo_weight' type='text' name='weight' disabled value='$weight'>" ?>
        </div>
        <div class="input-group">
            <label for="demo_occupation">Occupation:</span>
            <?php echo "<input id='demo_occupation' type='text' name='occupation' disabled value='$occupation'>" ?>
        </div>
        <br>
        <input id="cancel" type="submit" value="Back" name="submit" />
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
</body>
</html>
<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>