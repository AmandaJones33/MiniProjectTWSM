<?php 
	session_start();

	//Users
	$username = "";
	$email = "";
	$first_name = "";
	$last_name = "";
	$phone_number = "";
	$csgo = false;
	$lol = false;
	$admin = false;



	$errors = array();

//USER REGISTRATION
	//setting up connection to the database
						//server, user, password, name of db
	$db = mysqli_connect('localhost', 'root', '', 'registration');

	//if the register button is clicked: 
	if (isset($_POST['register'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password_1 = $_POST['password_1'];
		$password_2 = $_POST['password_2'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$phone_number = $_POST['phone_number'];
		
		if (isset($_POST['admin'])) {
			$admin = true;
		}
		if (isset($_POST['csgo'])) {
			$csgo = true;
		}
		if (isset($_POST['lol'])) {
			$lol = true;
		}


		//ensure that all fields are filled properly 
		//add error to errors array
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
			// check database for username
		$query_username = "SELECT username FROM users WHERE username='$username'";
		$result_username = mysqli_query($db, $query_username);
		if (mysqli_num_rows($result_username) != 0) {
			array_push($errors, "Username already exists");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password_1)) {
			array_push($errors, "Password is required");
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		if (empty($first_name)) {
			array_push($errors, "First name is required");
		}
		if (empty($last_name)) {
			array_push($errors, "Last name is required");
		}
		if (empty($phone_number)) {
			array_push($errors, "Phone number is required");
		}
		if (!is_numeric($phone_number) && !empty($phone_number)) {
			array_push($errors, "Phone number has to be numeric");
		
		}
		//if there are no errors - save user to database

		if (count($errors) == 0) {
			echo "test";
			$password = md5($password_1); //encrypt password before storing in databbase
			$sql = "INSERT INTO users (username, email, password, first_name, last_name, phone_number, admin, csgo, lol) VALUES ('$username', '$email', '$password', '$first_name', '$last_name', '$phone_number', '$admin', '$csgo', '$lol')";
			mysqli_query($db, $sql);

			$_SESSION['success_user'] = "You successfully created a new user!";

			header('location: index_admin.php');
		}else{
			//echo "something went wrong";
		}
	

	}

	//LOGIN
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result = mysqli_query($db, $query);
			if (mysqli_num_rows($result) == 1) {
				// log user in
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				$row = mysqli_fetch_assoc($result);
				$is_admin = $row["admin"];

				//Check if admin and redirect to either employee or admin homepage
				if ($is_admin) {
					header('location: index_admin.php');
					// echo "is admin";
				}
				else{
					header('location: indeex_employee.php');
					//echo "is not admin";
				}
				

			}
			else{
				array_push($errors, "Wrong username/password combination");
			}
		}
	}



	//logout
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
	}


 ?>