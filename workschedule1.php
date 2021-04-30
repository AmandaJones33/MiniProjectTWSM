<?php 
	include('server_workplaces.php');
	include('server.php');
 function get_schools(){
			$db = mysqli_connect('localhost', 'root', '', 'registration'); 
			$row = array();
			// Check connection
			if (!$db) {
			  die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "SELECT school_name FROM workplaces";
			$result = mysqli_query($db, $sql);

			
			if (mysqli_num_rows($result) > 0) {
			  // output data of each row
			  $row = mysqli_fetch_assoc($result);
			  return $row;
			}
			
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Assign hours</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Your work hours</h2>
	</div>

	<form method="post" action="insert_hours.php">
		School name: 
		<select>
			<option selected="selected">School</option>	
			<?php

			$schools = array();

			foreach (get_schools() as $item) {
				echo "<option value='strtolower($item)'>$item</option>";
			}
		
			?>

		</select>
		<input type="submit" value="Submit">
	
	<div class="input-group">
		<p>
			Return to homepage: <a href="index_admin.php">Back</a>
		</p>

	</div>		
	</form>




</body>
</html>