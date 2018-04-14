<?php 
	session_start();
	require 'functions.php';
    if (!isset($_SESSION['username'])){
		header( 'Location: login.php' );
	}
    $user = '' ;//Grab user from somewhere(maybe URL route?)
	$data = getUserInfo($user);
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
        <a href="logout.php" class="homeLink">Log Out</a>

        <div class="adminNavBox">
            <?php echo "<h4>User: ".$data['username']."</h4><br>" ?>
			<table style="width:100%">
				<tr>
					<th>First Name</th>
					<th>Last Name</th> 
					<th>Address</th>
					<th>City</th>
					<th>State</th> 
					<th>Postal Code</th>
					<th>Gender</th>
					<th>Birth Date</th> 
					<th>Height</th>
					<th>Weight</th>
					<th>Occupation</th>
				 </tr>
				  <tr>
					<td><?php echo $data['fName'] ?></td>
					<td><?php echo $data['lName'] ?></td>
					<td><?php echo $data['address'] ?></td>
					<td><?php echo $data['city'] ?></td>
					<td><?php echo $data['state'] ?></td>
					<td><?php echo $data['pCode'] ?></td>
					<td><?php echo $data['gender'] ?></td>
					<td><?php echo $data['birthDate'] ?></td>
					<td><?php echo $data['height'] ?></td>
					<td><?php echo $data['weight'] ?></td>
					<td><?php echo $data['occupation'] ?></td>
				  </tr>
			</table>
        </div>
    </body>
</html>