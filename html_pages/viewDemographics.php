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
    <title>View Demographics</title>
</head>

<body>
<div class="panel panel-info report-search-box">
    <div class="panel-heading">
        <h3 class="panel-title">Create New User</h3>
    </div>
    <form action="" method="POST" class="panel-body">
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
            <label for="demo_occupation">Birth Date:</span>
            <?php echo "<input class='form-control' id='demo_bDate' type='text' name='birthDate' disabled value='$birthDate'>" ?>
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
            <?php echo "<input class='form-control' id='demo_occupation' type='text' name='occupation' disabled value='$occupation'>" ?>
        </div>
    </form>
<div class="userNavBox">
    <div class="list-group">
	<a class="list-group-item list-group-item-info" href="updateDemographics.php">Update my Demographics</a>
	<a class="list-group-item list-group-item-info" href="user-lobby.php">Cancel</a>
    </div>
</div>
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
