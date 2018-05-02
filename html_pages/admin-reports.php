<?php session_start();
    require 'functions.php';
    redirect();
?>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="style.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <script
                src="https://code.jquery.com/jquery-1.12.4.min.js"
                integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                crossorigin="anonymous"></script>
        <script src="reporting.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body>
        <div class="title">
            <h1>Administrative Reports</h1>
        </div>
        <a href="admin-lobby.php" class="homeLink">Return to Lobby</a>

        <div class="report-search-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <label for="report">Select a Report</label>
                        <select class="form-control" id="reportId" placeholder="Select a Report">
                            <option value=""></option>
                            <option value="0">Average Heart Rate Per Day/City</option>
                            <option value="2">Total Steps Per Day/Occupation</option>
                            <option value="3">Total Steps Per User/Year</option>
                        </select>  
                    </div>
                </div>
                
            </div> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="from">From</label>
                        <input class="form-control date-input" type="date" id="from">
                    </div>
                    <div class="col-lg-3">
                        <label for="to">To</label>
                        <input class="form-control date-input" type="date" id="to">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 ">
                        <br>
                        <button id="runReport" onclick="search()" class="btn btn-default" type="button">Run Report</button>
                    </div>
                </div>
                <hr>    
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr id="tableHeaders">
                               
                            </tr>
                        </thead>
                        <tbody id="results">
            
                        </tbody>
                    </table>   
                </div>
            </div>
            
        </div>
        <img id="logo" src="<?php if($_SESSION['useMongo']==0) { echo "https://www.mysql.com/common/logos/logo-mysql-170x115.png";} else {echo "https://zdnet3.cbsistatic.com/hub/i/r/2018/02/16/8abdb3e1-47bc-446e-9871-c4e11a46f680/resize/370xauto/8a68280fd20eebfa7789cdaa6fb5eff1/mongo-db-logo.png";} ?>" class="db-logo"></img>

    </body>
    <script>
        setDateDefaults();
       
    </script>
</html>