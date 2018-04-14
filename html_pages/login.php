<?php
    session_start();
    require 'functions.php';
    $loginError = '';
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
                            Username: <input id="login_username" type='text' name='username'>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            Password:   <input id="login_pword" type='password' name='password'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="loginError"><?php echo $loginError; ?></span>
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
</body>
</html>
<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

