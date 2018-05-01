<?php 
	session_start();
	require 'functions.php';
    if (!isset($_SESSION['username'])){
		header( 'Location: login.php' );
	}
    $user = $_GET['user'] ;
	$data = getUserInfo($user)[0];
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
            <h1>User Info</h1>
        </div>
        <a href="search.php" class="homeLink">Return to Search</a>

        <div class="adminNavBox">
            <?php echo "<h4>User: ".$data['username']."</h4><br>" ?>
			<table style="width:100%">
				
				<tr>
					<th>First Name</th>
					<td><?php echo $data['fName'] ?></td>
				</tr>
				<tr>
					<th>Last Name</th> 
					<td><?php echo $data['lName'] ?></td>
				</tr>
				<tr>
					<th>Address</th>
					<td><?php echo $data['address'] ?></td>
				</tr>
				<tr>
					<th>City</th>
					<td><?php echo $data['city'] ?></td>
				</tr>
				<tr>
					<th>State</th> 
					<td><?php echo $data['state'] ?></td>
				</tr>
				<tr>
					<th>Postal Code</th>
					<td><?php echo $data['pCode'] ?></td>
				</tr>
				<tr>
					<th>Gender</th>
					<td><?php echo $data['gender'] ?></td>
				</tr>
				<tr>
					<th>Birth Date</th> 
					<td><?php echo $data['birthDate'] ?></td>
				</tr>
				<tr>
					<th>Height</th>
					<td><?php echo $data['height'] ?></td>
				</tr>
				<tr>
					<th>Weight</th>
					<td><?php echo $data['weight'] ?></td>
				</tr>
				<tr>
					<th>Occupation</th>
					<td><?php echo $data['occupation'] ?></td>
				</tr>

			</table>
		</div>
		<img id="logo" src="<?php if($_SESSION['useMongo']==0) { echo "https://www.mysql.com/common/logos/logo-mysql-170x115.png";} else {echo "https://zdnet3.cbsistatic.com/hub/i/r/2018/02/16/8abdb3e1-47bc-446e-9871-c4e11a46f680/resize/370xauto/8a68280fd20eebfa7789cdaa6fb5eff1/mongo-db-logo.png";} ?>" class="db-logo"></img>

    </body>
</html>
