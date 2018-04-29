<?php session_start();
    require 'functions.php';
    redirect();
    if ($_SESSION['admin']==1){
        header( 'Location: admin-lobby.php' );
    } 
?>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="style.css" type="text/css" rel="stylesheet">
        <script
                src="https://code.jquery.com/jquery-1.12.4.min.js"
                integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                crossorigin="anonymous"></script>
    
    </head>
    <body>
        <div class="title">
            <h1>Welcome to Stepping Up</h1>
        </div>
        <a href="logout.php" class="homeLink">Log Out</a>

        <div class="adminNavBox">
            <?php echo "<h4>Welcome to Stepping Up, ".$_SESSION['username']."!</h4><br>" ?>
            <div class="list-group">
                <a class="list-group-item list-group-item-info" href="viewDemographics.php">View/Update my Demographic Data</a>
                <a class="list-group-item list-group-item-info" href="device.php">View Device Usage History</a>
            </div>
        </div>
        <img id="logo" src="<?php if($_SESSION['useMongo']==0) { echo "https://www.mysql.com/common/logos/logo-mysql-170x115.png";} else {echo "https://zdnet3.cbsistatic.com/hub/i/r/2018/02/16/8abdb3e1-47bc-446e-9871-c4e11a46f680/resize/370xauto/8a68280fd20eebfa7789cdaa6fb5eff1/mongo-db-logo.png";} ?>" class="db-logo"></img>

    </body>
</html>
