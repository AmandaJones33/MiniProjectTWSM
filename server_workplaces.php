<?php  

//session_start();

	//Workplaces
	$school_name = "";
	$street_name = "";
	$street_number = "";
	$postal_code = "";
	$city = "";
	$csgo = false;
	$lol = false;
	$salary = "";

	$errors = array();

//USER REGISTRATION
	//setting up connection to the database
						//server, user, password, name of db
	$db = mysqli_connect('localhost', 'root', '', 'registration');

	//if the register button is clicked: 

	//WORKPLACE REGISTRATION

	if (isset($_POST['register_work'])) {
		
		$school_name = $_POST['school_name'];
		$street_name = $_POST['street_name'];
		$street_number = $_POST['street_number'];
		$postal_code = $_POST['postal_code'];
		$city = $_POST['city'];
		$salary = $_POST['salary'];

		if (isset($_POST['csgo'])) {
			$csgo = true;
		}
		if (isset($_POST['lol'])) {
			$lol = true;
		}
		//ensure that all fields are filled properly 
		//add error to errors array
		if (empty($school_name)) {
			array_push($errors, "Name of the school is required");
		}
			// check database for schools in the system
		$query_school = "SELECT school_name FROM workplaces WHERE school_name='$school_name'";
		$result_school = mysqli_query($db, $query_school);
		if (mysqli_num_rows($result_school) != 0) {
			array_push($errors, "School already exists");
		}
		if (empty($street_name)) {
			array_push($errors, "Street name is required");
		}
		if (empty($street_number)) {
			array_push($errors, "Street number is required");
		}
		if (empty($postal_code)) {
			array_push($errors, "Postal code is required");
		}
		if (empty($salary)) {
			array_push($errors, "Salary pr hour is required");
		}

		if (!is_numeric($postal_code) && !empty($postal_code)) {
			array_push($errors, "Postal code has to be numeric");
		}

		if (count($errors) == 0) {
			$sql = "INSERT INTO workplaces (school_name, street_name, street_number, postal_code, city, salary, csgo, lol) VALUES ('$school_name', '$street_name', '$street_number', '$postal_code', '$city', '$salary', '$csgo', '$lol')";
			mysqli_query($db, $sql);

			
			$_SESSION['success_work'] = "You successfully created a new School";
			
			header('location: index_admin.php');
		}
	}



?>