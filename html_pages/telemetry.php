<?php session_start();
    require 'functions.php';
    redirect();
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
        <script src="telemetry.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body>
        <div class="title">
            <h1>Telemetry</h1>
        </div>
        <a href="admin-lobby.php" class="homeLink">Return to Lobby</a>

        <div id="hr_chart" style="display: inline-block; width: 650px; height: 400px;"></div>
        <div id="steps_chart" style="display: inline-block; width: 650px; height: 400px;"></div>
      
    </body>
    <script>initChart(); </script>
</html>