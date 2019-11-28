<?php
	session_start();

	// variable declaration
	$username = "";
	$fname    = "";
	$lname    = "";
	$cred_num = "";
	$company = "";
	$street = "";
	$city = "";
	$state = "";
	$zipcode = "";
	$statusInput = "";
	$theater_name = "";
	$manager = "";
	$capacity = -1; // “Capacity” of a theater is the maximum number of movies it can play for the same date
	$errors = array();
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'atlanta_movies');

	// CUSTOMER REGISTRATION
	if (isset($_POST['reg_customer'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($fname)) { array_push($errors, "First name is required"); }
		if (empty($lname)) { array_push($errors, "Last name is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match");
		}

		// check to see if username is already registered in system
		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "You already have an account");
		}

		/*
		// check to see if credit card number is already registered in system
		$number = 5;
		for($i=0; $i<$number; $i++) {
			$cred = "" ;
			$cred = $_POST["mytext"][$i] ;
			if($cred == '') {
				array_push($errors, "One credit invalid.");
			} elseif (strlen($cred) != 16) {
				array_push($errors, "One credit invalid.");
			} else {
				$query = "SELECT creditCardNum FROM creditcard WHERE creditCardNum='$cred'";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1) {
					array_push($errors, "One credit card already exists. Please use another one.");
				} else {

				}
			}
		}




		// register customer if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1); //encrypt the password before saving in the database
			// add customer to database
			$query = "call atlanta_movies.customer_only_register('$username', '$password', '$fname', '$lname')";
			mysqli_query($db, $query);
			// add credit card number to database
			for($i=0; $i<$number; $i++) {
				$cred = "" ;
				$cred = $_POST["mytext"][$i] ;
				if($cred == '') {
				} elseif (strlen($cred) != 16) {
				} else {
					$query = "SELECT creditCardNum FROM creditcard WHERE creditCardNum='$cred'";
					$results = mysqli_query($db, $query);
					if (mysqli_num_rows($results) == 1) {
					} else {
						$query = "call atlanta_movies.customer_add_creditcard('$username', '$cred')";
						mysqli_query($db, $query);
					}
				}
			}
			*/

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		//}

	}

	// CREATE THEATER
	if (isset($_POST['create_theater'])) {
		// receive all input values from the form
		$theater_name = mysqli_real_escape_string($db, $_POST['theater_name']);
		$company    = mysqli_real_escape_string($db, $_POST['company']);
		$street    = mysqli_real_escape_string($db, $_POST['street']);
		$city    = mysqli_real_escape_string($db, $_POST['city']);
		$state    = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode    = mysqli_real_escape_string($db, $_POST['zipcode']);
		$capacity    = mysqli_real_escape_string($db, $_POST['capacity']);
		$manager    = mysqli_real_escape_string($db, $_POST['manager']);

		// form validation: ensure that the form is correctly filled
		if (empty($theater_name)) { array_push($errors, "Theater name is required"); }
		if (empty($company)) { array_push($errors, "Company is required"); }
		if (empty($street)) { array_push($errors, "Street address is required"); }
		if (empty($city)) { array_push($errors, "City is required"); }
		if (empty($state)) { array_push($errors, "State is required"); }
		if (empty($zipcode)) { array_push($errors, "Zipcode is required"); }
		if (empty($capacity)) { array_push($errors, "Capacity is required"); }

		if (strlen($zipcode) != 5) {
			array_push($errors, "Enter a valid zipcode");
		}

		// capacity must be > 1 and an int type
		if ((int)$capacity < 1) {
			array_push($errors, "Enter a valid capacity");
		}

		// check to see if theater is already registered in system
		$query = "SELECT * FROM theater WHERE thName='$theater_name' AND comName = '$company'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) != 0) {
			array_push($errors, "Theater already in the system");
		}

		// create theater if no errors
		if (count($errors) == 0) {
			$manager = $_POST['manager'];
			$query = "call atlanta_movies.admin_create_theater('$theater_name', '$company', '$street', '$city', '$state', '$zipcode', '$capacity', '$manager')";
			mysqli_query($db, $query);
			header('location: 14 admin manage company.php');
		}
	}

	// MANAGER REGISTRATION
	if (isset($_POST['reg_manager'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$company    = mysqli_real_escape_string($db, $_POST['company']);
		$street    = mysqli_real_escape_string($db, $_POST['street']);
		$city    = mysqli_real_escape_string($db, $_POST['city']);
		$state    = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode    = mysqli_real_escape_string($db, $_POST['zipcode']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($fname)) { array_push($errors, "First name is required"); }
		if (empty($lname)) { array_push($errors, "Last name is required"); }
		if (empty($company)) { array_push($errors, "Company is required"); }
		if (empty($street)) { array_push($errors, "Street address is required"); }
		if (empty($city)) { array_push($errors, "City is required"); }
		if (empty($state)) { array_push($errors, "State is required"); }
		if (empty($zipcode)) { array_push($errors, "Zipcode is required"); }

		if (strlen($zipcode) != 5) {
			array_push($errors, "Enter a valid zipcode");
		}
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match");
		}

		// check to see if username is already registered in system
		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "You already have an account");
		}

		// check to see if address already exists
		$query = "SELECT * FROM manager
					WHERE (manStreet = '$street' AND manCity = '$city' AND manState = '$state' AND manZipcode = '$zipcode')";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "Address already exists");
		}

		// register customer if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1); //encrypt the password before saving in the database
			// add customer to database
			$password = $password_1;
			$query = "call atlanta_movies.manager_only_register('$username', '$password', '$fname', '$lname', '$company', '$street', '$city', '$state', '$zipcode')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// MANAGER CUSTOMER REGISTRATION
	if (isset($_POST['reg_manager_customer'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$company    = mysqli_real_escape_string($db, $_POST['company']);
		$street    = mysqli_real_escape_string($db, $_POST['street']);
		$city    = mysqli_real_escape_string($db, $_POST['city']);
		$state    = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode    = mysqli_real_escape_string($db, $_POST['zipcode']);
		$cred_num    = mysqli_real_escape_string($db, $_POST['cred_num']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($fname)) { array_push($errors, "First name is required"); }
		if (empty($lname)) { array_push($errors, "Last name is required"); }
		if (empty($company)) { array_push($errors, "Company is required"); }
		if (empty($street)) { array_push($errors, "Street address is required"); }
		if (empty($city)) { array_push($errors, "City is required"); }
		if (empty($state)) { array_push($errors, "State is required"); }
		if (empty($zipcode)) { array_push($errors, "Zipcode is required"); }
		if (empty($cred_num)) { array_push($errors, "Credit card number is required"); }

		if (strlen($cred_num) != 16) {
			array_push($errors, "Enter a valid credit card number");
		}
		if (strlen($zipcode) != 5) {
			array_push($errors, "Enter a valid zipcode");
		}
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match");
		}

		// check to see if username is already registered in system
		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "You already have an account");
		}

		// check to see if address already exists
		$query = "SELECT * FROM manager
					WHERE (manStreet = '$street' AND manCity = '$city' AND manState = '$state' AND manZipcode = '$zipcode')";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "Address already exists");
		}

		// check to see if credit card number is already registered in system
		$query = "SELECT creditCardNum FROM creditcard WHERE creditCardNum='$cred_num'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "Credit card already exists. Please use another one.");
		}

		// register customer if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1); //encrypt the password before saving in the database
			// add customer to database
			$password = $password_1;
			$query = "call atlanta_movies.manager_customer_register('$username', '$password', '$fname', '$lname', '$company', '$street', '$city', '$state', '$zipcode')";
			mysqli_query($db, $query);
			// add credit card number to database
			$query = "call atlanta_movies.manager_customer_add_creditcard('$username', '$cred_num')";
			mysqli_query($db, $query);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// USER REGISTRATION
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($fname)) { array_push($errors, "First name is required"); }
		if (empty($lname)) { array_push($errors, "Last name is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// check to see if username is already registered in system
		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1
			AND $password_1 != null
			AND $password_2 != null
			AND $fname != null
			AND $lname != null
			AND $username != null) {
			array_push($errors, "You already have an account");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1); //encrypt the password before saving in the database
			$password = $password_1 ;
			$query = "call atlanta_movies.user_register('$username', '$password', '$fname', '$lname')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}


	// ...

	// APPROVE USER
	if (isset($_POST['approve_user'])) {

		$query = "call atlanta_movies.admin_approve_user('$username')";
		mysqli_query($db, $query);
	}


	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			//echo $password;
			$password = md5($password);
			//echo $password;
			$query = "call atlanta_movies.get_userType('$username')";
			mysqli_query($db, $query);
			$query = "SELECT * FROM atlanta_movies.user WHERE username = '$username' AND password = '$password'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				$query = "SELECT userType FROM user_type WHERE username='$username'";
				$thistype = "" ;
				$thistype = mysqli_query($db, $query);
				//echo $thistype;
				$thisrow = mysqli_fetch_array($thistype) ;
				//echo $thisrow[0];

				if ($thisrow[0] == "CustomerManager") {
					header('location: 10 manager customer functionality.php');
					//echo $row[0];
				} else if ($thisrow[0] == "CustomerAdmin") {
					header('location: 8 admin customer functionality.php');
				} else if ($thisrow[0] == "Admin") {
					header('location: 7 admin only functionality.php');
				} else if ($thisrow[0] == "Manager") {
					header('location: 9 manager only functionality.php');
				} else if ($thisrow[0] == "Customer") {
					header('location: 11 customer functionality.php');
				} else if ($thisrow[0] == "User") {
					header('location: 12 user functionality.php');
				} else {
					header('location: index.php');
				}

			} else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>
