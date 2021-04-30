<?php 
	include('server.php');

	if (empty($_SESSION['username'])) {
		header('location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register new user</h2>

	</div>

	<form method="post" action="register.php">
		<!-- display validatioin errors here -->
		<?php include('errors.php'); ?>



		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="first_name" value="<?php echo $first_name; ?>">
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="last_name" value="<?php echo $last_name; ?>">
		</div>
		<div class="input-group">
			<label>Phone number</label>
			<input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
		</div>
		<div class="input-group">
			<label>CS:GO</label>
			<input type="checkbox" name="csgo">
		</div>
		<div class="input-group">
			<label>LOL</label>
			<input type="checkbox" name="lol">
		</div>
		<div class="imput-group">
			<label>Admin</label>
			<input type="checkbox" name="admin"> <br> This will give the user admin rights
		</div>
		<div class="input-group">
			<button type="submit" name="register" class="btn">Register</button>
		</div>

		<p>
			Cancel registration <a href="index_admin.php">Click here</a>
		</p>

	</form>

</body>
</html>