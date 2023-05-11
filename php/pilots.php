<!DOCTYPE html>
<html>
<head>
	<title>List of Users</title>
</head>
<body>
	<?php
		require_once ('utils/db_connect.php');
		require("utils/functions.php");

		// check if user is logged in and is an admin
		if(isset($_SESSION['id']) && isChief()){
			// display the form to add pilots
			require ('add_pilot.php');

			// get all pilots from the database
			$query = "SELECT * FROM pilots";
    $req = $db->prepare($sql);
    $req->execute();
    $row=$req->fetch(PDO::FETCH_ASSOC);

			// display the table with all pilots info
			echo '<table>';
			echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Chief</th><th>Birthdate</th><th>Email</th><th>Profile Picture</th><th>Street Number</th><th>Street Name</th><th>Zip Code</th><th>City</th><th>Flight Hours</th></tr>';
			while($row){
				echo '<tr><td>'.$row['id'].'</td><td>'.$row['firstname'].'</td><td>'.$row['lastname'].'</td><td>'.$row['chief'].'</td><td>'.$row['birthdate'].'</td><td>'.$row['email'].'</td><td>'.$row['profile_picture'].'</td><td>'.$row['street_number'].'</td><td>'.$row['street_name'].'</td><td>'.$row['zip_code'].'</td><td>'.$row['city'].'</td><td>'.$row['flight_hours'].'</td></tr>';
			}
			echo '</table>';

		}else{
			// display only the users table with limited columns
			$sql = "SELECT id, firstname, lastname, email, profile_picture FROM pilots";
			$req = $db->prepare($sql);
      $req->execute();
      $row=$req->fetch(PDO::FETCH_ASSOC);

			echo '<table>';
			echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Profile Picture</th></tr>';
			while($row){
				echo '<tr><td>'.$row['id'].'</td><td>'.$row['firstname'].'</td><td>'.$row['lastname'].'</td><td>'.$row['email'].'</td><td>'.$row['profile_picture'].'</td></tr>';
			}
			echo '</table>';
		}
	?>
</body>
</html>
