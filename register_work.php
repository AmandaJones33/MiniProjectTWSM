<?php 
	include('server_workplaces.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>School registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register new school</h2>

	</div>

	<form method="post" action="register_work.php">
		<!-- display validatioin errors here -->
		<?php include('errors.php'); ?>



		<div class="input-group">
			<label>Name of School</label>
			<input type="text" name="school_name" value="<?php echo $school_name;?>">
		</div>
		<div class="input-group">
			<label>Street name</label>
			<input type="text" name="street_name" value="<?php echo $street_name; ?>">
		</div>
		<div class="input-group">
			<label>Number</label>
			<input type="text" name="street_number" value="<?php echo $street_number; ?>">
		</div>
		<div class="input-group">
			<label>Postal code</label>
			<input type="text" name="postal_code" value="<?php echo $postal_code?>">
		</div>
		<div class="input-group">
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city?>">
		</div>
		<div class="input-group">
			<label>CS:GO</label>
			<input type="checkbox" name="csgo">
			<label>LOL</label>
			<input type="checkbox" name="lol">
		</div>
		<div class="input-group">
			<label>Salary pr hour</label>
			<input type="text" name="salary" value="<?php echo $salary; ?>">
		</div>

		<div class="input-group">
			<button type="submit" name="register_work" class="btn">Register School</button>
		</div>


		
		<p>
			Cancel registration <a href="index_admin.php">Click here</a>
		</p>

	</form>

</body>
</html>