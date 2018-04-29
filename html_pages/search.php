<?php session_start();
    require 'functions.php';
    redirect();
?>
<html>
    <head>
        <title>Stepping Up - User Search</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="style.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <script src="search.js"></script>
        <script
                src="https://code.jquery.com/jquery-1.12.4.min.js"
                integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body>
        <div class="title">
            <h1>User Search</h1>
        </div>
        <a href="admin-lobby.php" class="homeLink">Return to Lobby</a>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                    <input id="searchText" type="text" class="form-control" placeholder="search by last name, first name, or user name">
                    <span class="input-group-btn">
                        <button onclick="search()" class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody id="results">

            </tbody>
        </table>
        <img id="logo" src="<?php if($_SESSION['useMongo']==0) { echo "https://www.mysql.com/common/logos/logo-mysql-170x115.png";} else {echo "https://zdnet3.cbsistatic.com/hub/i/r/2018/02/16/8abdb3e1-47bc-446e-9871-c4e11a46f680/resize/370xauto/8a68280fd20eebfa7789cdaa6fb5eff1/mongo-db-logo.png";} ?>" class="db-logo"></img>

    </body>
</html>