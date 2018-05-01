<?php
    session_start();
    require 'functions.php';
   
    $loginError = '';
    if (!isset($_SESSION['useMongo'])) {
        $_SESSION['useMongo']=0;
    }
    //echo extension_loaded("mongodb") ? "mongo loaded\n" : "mongo not loaded\n";
    //$conn =  new MongoDB\Client();
	//$db = $conn->steppingup;
   

   // $connection = new MongoClient();
   /* if (isset($_SESSION['username'])) {
        if ($_SESSION['admin']==0){
            header( 'Location: user-lobby.php' );
        } else {
            header( 'Location: admin-lobby.php' );
        }
    } */
    if (isset($_POST['submit']) && isset($_POST['username']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $loginResult = validateLogin($_POST['username'], $_POST['password']);
        $loginError = $loginResult['message'];
        if ($loginResult['isValid']==1) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['admin'] = $loginResult['admin'];
            if ($_SESSION['admin']==1)
                header( 'Location: admin-lobby.php' );
            else
                header( 'Location: user-lobby.php' );
        }
    }
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css" />
    <title>Stepping Up</title>
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 150px;">
            <div class="col-md-12 text-center">
                <h1>Stepping Up</h1>
                <h5>Your daily activity tracker!</h5>
            </div>
        </div>
        <div id="login_form_wrapper">
            <div class="row text-center">
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="id">Username:</label>
                            <input id="login_username" type='text' name='username'>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="login_pword">Password:</label>
                            <input id="login_pword" type='password' name='password'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="loginError"><?php echo $loginError; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="dbToggle" type="checkbox" data-toggle="toggle" data-on="NoSql" data-off="MySql">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="login_button" type='submit' value="Log In" name='submit'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="row text-center">
                <div class="col-md-12" id="register">
                    Pleaser register <a href="create-new-user.php">here!</a> if you are not already a member.
                </div>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
   <?php if ($_SESSION['useMongo']==0) { echo "$('#dbToggle').bootstrapToggle('off');"; } else {echo "$('#dbToggle').bootstrapToggle('on');";}  ?>
    $('#dbToggle').change(function() {
        document.location.href = "switch-db.php";
    })
    
</script>

