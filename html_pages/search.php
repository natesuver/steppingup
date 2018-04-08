<?php session_start();
    if (!isset($_SESSION['username']))
        header( 'Location: login.php' );
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
        <a href="logout.php" class="homeLink">Log Out</a>
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
    </body>
</html>