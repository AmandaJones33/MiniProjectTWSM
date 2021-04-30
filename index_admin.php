<?php 
	include('server.php');
	include('server_workplaces.php');
/*
	if (empty($_SESSION['username'])) {
		header('location: login.php');
	}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin homepage</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home page for Admin</h2>
	</div>

	<div class="content">
		<?php if (isset($_SESSION['success'])): ?>
			<div class="error success">
				<h3>
					<?php  
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<?php if (isset($_SESSION['success_user'])): ?>
			<div class="error success">
				<h3>
					<?php  
						echo $_SESSION['success_user'];
						unset($_SESSION['success_user']);
					?>
				</h3></div>
		<?php endif ?>
		<?php if (isset($_SESSION['success_work'])): ?>
			<div class="error success">
				<h3>
					<?php  
						echo $_SESSION['success_work'];
						unset($_SESSION['success_work']);
					?>
				</h3></div>
		<?php endif ?>
		
			
		<?php if (isset($_SESSION['username'])): ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p>	<a href="index_admin.php?logout='1'" style="color: red;">Logout</a></p>
		<?php endif ?>
			

	</div>
	<div class="content">
	<table>
		
		<tr>
			<td></td>
			<td><a href="register.php">Register new user</a><td>
		</tr>
		
		<tr>
			<td></td>
			<td><a href="register_work.php">Register new school</a></td>
		</tr>
		<tr>
			<td></td>
			<td><a href="workschedule.php">Register work</a></td>
		</tr>
		<tr>
			<td></td>
			<td><a href="admin_overview.php">Employee overview</a></td>
		</tr>
	</table>
	</div>	


</body>
</html>