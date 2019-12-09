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

	$movie_name = "";
	$release_date = "";
	$movie_duration = "";
	$statusInput = "" ;

	$min_date = "";
	$max_date = "";
	$visit_date = "";


	$errors = array();
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'team7');

	// CUSTOMER REGISTRATION
	if (isset($_POST['reg_customer'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);

		// ALL fields are required
		// Check if user is already registered
		if (mysqli_num_rows($results) == 1) {
			array_push($errors, "You already have an account.");
		} else if (empty($username) || empty($fname) || empty($lname) || empty($password_1)) {
			array_push($errors, "All fields are required.");
		} else if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match.");
		} else if (strlen($password_1) < 8) {
			array_push($errors, "Password is too short.");
		}

		// check to see if credit card number is already registered in system
		$number = 0;
		$valid_cred = 0;
		$number = count($_POST["mytext"]);
		if($number > 1)
		{
			for($i=1; $i<$number; $i++)
			{
				$thiscred = trim($_POST["mytext"][$i]) ;
				if($thiscred == '')
				{
					array_push($errors, "Credit number " . $i . " is blank");
					//echo $i ;
				} else if(strlen($thiscred) != 16) {
					array_push($errors, "Credit number " . $i . " is invalid");
				} else {
					$query = "SELECT creditCardNum FROM creditcard WHERE creditCardNum='$thiscred'";
					$results = mysqli_query($db, $query);
					if (mysqli_num_rows($results) == 1) {
						array_push($errors, "Credit number " . $i . " already exists");
					} else {
						$check_dub = 0;
						for($j=1;$j<$i; $j++) {
							if($thiscred == trim($_POST["mytext"][$j])) {
								$check_dub = $check_dub + 1 ;
							}
						}
						if($check_dub == 0) {
							$valid_cred = $valid_cred + 1;
						} else {
							array_push($errors, "Credit number " . $i . " is duplicated");
						}
					}
				}
			}
		}

		if($valid_cred == 0) {
			array_push($errors, "Please enter at least a valid credit card number!");
		}


		// register customer if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1); //encrypt the password before saving in the database
			$password = $password_1 ;
			// add customer to database
			$query = "call customer_only_register('$username', '$password', '$fname', '$lname')";
			mysqli_query($db, $query);
			// add credit card number to database
			$number = count($_POST["mytext"]);
			for($i=1; $i<$number; $i++)
			{
				$thiscred = trim($_POST["mytext"][$i]) ;
				$query = "call  customer_add_creditcard('$username', '$thiscred')";
				mysqli_query($db, $query);
			}


			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: 11 customer functionality.php');
		}

	}

	// SCHEDULE MOVIE
	if (isset($_POST['schedule_movie'])) {
		// receive all input values from the form
		$movie_name = mysqli_real_escape_string($db,$_POST['movie_name']);
		//echo $movie_name;

		$release_date = $_POST['release_date'];
		$play_date = $_POST['play_date'];

		// form validation: ensure that the form is correctly filled
		if (empty($play_date)) { array_push($errors, "Play date is required"); }
		if (empty($release_date)) { array_push($errors, "Release date is required"); }

		// Play date must be after release date
		if ($play_date < $release_date) {
			array_push($errors, "Play date must be after release date");
		}

		// check to see if movie is valid
		$query = "SELECT * FROM movie WHERE movName = '$movie_name' AND movReleaseDate = '$release_date'";
		$results = mysqli_query($db, $query);
		//echo mysqli_num_rows($results);
		//echo $release_date;
		if (mysqli_num_rows($results) == 0) {
			array_push($errors, "Movie does not exist");
		}

		// MUST CHECK PRIMARY KEY HEREEEE(SELECT thName, comName FROM theater WHERE i_manUsername = theater.manager);



		// CHECK AGAINNN
		// check to see if manager works for a company
		$username = $_SESSION['username'];
		$query = "SELECT * FROM theater WHERE manager = '$username'";
		$results = mysqli_query($db, $query);
		//echo mysqli_num_rows($results);
		//echo $release_date;
		if (mysqli_num_rows($results) == 0) {
			array_push($errors, "Only manager of a company can schedule a movie");
		} else {
			$query = "SELECT thName, comName FROM theater WHERE manager = '$username'";
			$results = mysqli_query($db, $query);
			$row = mysqli_fetch_array($results) ;
			$thetername = $row["thName"] ;
			$companyname = $row["comName"] ;
			//echo $thetername;
			//echo $companyname;

			$query = "SELECT * FROM movieplay WHERE thName = '$thetername' AND comName = '$companyname' AND movName = '$movie_name' AND movReleaseDate = '$release_date' AND movPlayDate = '$play_date' ";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				array_push($errors, "Movie already scheduled");
			}

		}





		// schedule movie if no errors
		if (count($errors) == 0) {
			$username = $_SESSION['username'];
			// schedule movie query



			$query = "call manager_schedule_mov('$username', '$movie_name', '$release_date', '$play_date')";
			mysqli_query($db, $query);
			$query = "SELECT  userType FROM user_type WHERE username='$username'";
			$thistype = "" ;
			$thistype = mysqli_query($db, $query);
			$thisrow = mysqli_fetch_array($thistype) ;
			if ($thisrow[0] == "Manager") {
				header('location: 9 manager only functionality.php');
			} else if ($thisrow[0] == "CustomerManager") {
				header('location: 10 manager customer functionality.php');
			}
		}
	}

	// CREATE MOVIE
	if (isset($_POST['create_movie'])) {
		// receive all input values from the form
		$movie_name = mysqli_real_escape_string($db, $_POST['movie_name']);
		$movie_duration    = mysqli_real_escape_string($db, $_POST['movie_duration']);
		//$release_date    = mysqli_real_escape_string($db, $_POST['release_date']);
		$release_date = $_POST['release_date'];

		// form validation: ensure that the form is correctly filled
		if (empty($movie_name)) { array_push($errors, "Movie name is required"); }
		if (empty($movie_duration)) { array_push($errors, "Movie duration is required"); }
		if (empty($release_date)) { array_push($errors, "Release date is required"); }

		// check to see if movie is already registered in system
		$query = "SELECT * FROM movie WHERE movName='$movie_name' AND movReleaseDate = '$release_date'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) != 0
			AND $movie_duration != null
			AND $movie_name != null) {
			array_push($errors, "Movie already in the system");
		}

		// create movie if no errors
		if (count($errors) == 0) {
			$query = "call admin_create_mov('$movie_name', '$movie_duration', '$release_date')";
			mysqli_query($db, $query);

			$username = $_SESSION['username'] ;
			$query = "SELECT  userType FROM user_type WHERE username='$username'";
			$thistype = "" ;
			$thistype = mysqli_query($db, $query);
			$thisrow = mysqli_fetch_array($thistype) ;
			echo $thisrow[0];
			if ($thisrow[0] == "CustomerAdmin") {
				header('location: 8 admin customer functionality.php');
			} else if ($thisrow[0] == "Admin") {
				header('location: 7 admin only functionality.php');
			}
		}
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

		$comquery = "SELECT * FROM theater WHERE manager='$manager'";
		$comsql = mysqli_query($db, $comquery);

		if(mysqli_num_rows($comsql) > 0) {
			array_push($errors, "You already manages a theater");
		}

		// check to see if theater is already registered in system
		$query = "SELECT * FROM theater WHERE thName='$theater_name' AND comName = '$company'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) != 0) {
			array_push($errors, "Theater already in the system");
		}

		// check to see if selected manager is belonged to selected company

		//$query = "SELECT * from manager WHERE username = $manager AND comName = $company";
		$query = "SELECT username FROM manager WHERE comName = '$company' AND username = '$manager'" ;
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 0) {
			array_push($errors, "Invalid manager/ company combination");
		}
		//echo $manager ;

		// create theater if no errors
		if (count($errors) == 0) {
			$manager = $_POST['manager'];
			$query = "call admin_create_theater('$theater_name', '$company', '$street', '$city', '$state', '$zipcode', '$capacity', '$manager')";
			mysqli_query($db, $query);

			$username = $_SESSION['username'] ;
			$query = "SELECT  userType FROM user_type WHERE username='$username'";
			$thistype = "" ;
			$thistype = mysqli_query($db, $query);
			$thisrow = mysqli_fetch_array($thistype) ;
			echo $thisrow[0];
			if ($thisrow[0] == "CustomerAdmin") {
				header('location: 8 admin customer functionality.php');
			} else if ($thisrow[0] == "Admin") {
				header('location: 7 admin only functionality.php');
			}
		}
	}

	// BACK BUTTON
	if (isset($_POST['this-back-button'])) {
		if (!isset($_SESSION['username'])) {
			$_SESSION['msg'] = "You must log in first";
			header('location: 1 login.php');
		}
		$username = $_SESSION['username'];
		//echo $username ;
		echo $_SESSION['username'];
		$query = "SELECT userType FROM user_type WHERE username='$username'";
		$thistype = "" ;
		$thistype = mysqli_query($db, $query);
		$thisrow = mysqli_fetch_array($thistype) ;
		//echo $thisrow[0];
		if ($thisrow[0] == "CustomerManager") {
			header('location: 10 manager customer functionality.php');

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
		}
	}

	if (isset($_POST['view_movie'])) {

		if(!isset($_POST['radmov'])) {
			array_push($errors, "You must select movie to view");
		}

		if (count($errors) == 0) {
			$movkey = $_POST['radmov'];
			list($thismovname, $thisredate,$thisthname,$thiscomname,$thisplaydate) = explode('[', $movkey);

			$thiscredit = isset($_POST['this_cred_num']) ? $thiscredit = $_POST['this_cred_num'] : $thiscredit = '' ;
			if (!isset($_SESSION['username'])) {
				$_SESSION['msg'] = "You must log in first";
				header('location: 1 login.php');
			}
			$username = $_SESSION['username'] ;

			$comquery = "call customer_view_history('$username')";
			$comsql = mysqli_query($db, $comquery);
			$comquery = "SELECT * FROM cosviewhistory WHERE movPlayDate='$thisplaydate' AND movName = '$thismovname' AND thName = '$thisthname' AND comName = '$thiscomname' AND creditCardNum = '$thiscredit'";
			$comsql = mysqli_query($db, $comquery);

			if(mysqli_num_rows($comsql) > 0) {
				array_push($errors, "You already logged your view for this movie.");
			}

			//$username = $_SESSION['username'] ;
			//echo $username;
			$comquery = "call customer_view_history('$username')";
			$comsql = mysqli_query($db, $comquery);
			$comquery = "SELECT * FROM cosviewhistory WHERE movPlayDate='$thisplaydate'";
			$comsql = mysqli_query($db, $comquery);
			if(mysqli_num_rows($comsql) >= 3) {
				array_push($errors, "You can only view three movies a day");
			}


			if (count($errors) == 0) {
				$query = "call  customer_view_mov('$thiscredit','$thismovname', '$thisredate', '$thisthname', '$thiscomname', '$thisplaydate')";
				mysqli_query($db, $query);
				//echo $username;

                $query = "SELECT userType FROM user_type WHERE username='$username'";
                $thistype = "" ;
                $thistype = mysqli_query($db, $query);
                $thisrow = mysqli_fetch_array($thistype) ;
                //echo $thisrow[0];
                if ($thisrow[0] == "CustomerManager") {
                    header('location: 10 manager customer functionality.php');
                } else if ($thisrow[0] == "CustomerAdmin") {
                    header('location: 8 admin customer functionality.php');
                } else if ($thisrow[0] == "Customer") {
                    header('location: 11 customer functionality.php');
                }
			}

		}


	}

	// LOG VISIT

	if (isset($_POST['log-visit'])) {
		if(!isset($_POST['radvis'])) {
			array_push($errors, "You must select one theater to visit");
		}

		if(empty($_POST['visit_date'])) {
			array_push($errors, "You must select one visit day");
		}
		if (!isset($_SESSION['username'])) {
			$_SESSION['msg'] = "You must log in first";
			header('location: 1 login.php');
		}

		if (count($errors) == 0) {
			$theaterkey = $_POST['radvis'];
			$visit_date = $_POST['visit_date'] ;
			$visitusername = $_SESSION['username'];
			list($thistheater, $thiscom) = explode('[', $theaterkey);
			//echo $thistheater ." ". $thiscom ." ". $visit_date ." ". $visitusername;
			$comquery = "call user_visit_th('$thistheater', '$thiscom', '$visit_date', '$visitusername')";
			// inputs: i_thName, i_comName, i_visitDate, i_username
			$comsql = mysqli_query($db, $comquery);



			$query = "SELECT userType FROM user_type WHERE username='$visitusername'";

			$thistype = "" ;
			$thistype = mysqli_query($db, $query);
			$thisrow = mysqli_fetch_array($thistype) ;
			echo $thisrow[0];
			if ($thisrow[0] == "CustomerManager") {
				header('location: 10 manager customer functionality.php');

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
			}


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

		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);

		// ALL fields are required
		// Check if user is already registered
		if (mysqli_num_rows($results) == 1) {
			array_push($errors, "You already have an account.");
		} else if (empty($username) || empty($fname) || empty($lname) ||
					empty($password_1) || empty($company) || empty($state) ||
					empty($street) || empty($city) || empty($zipcode)) {
			array_push($errors, "All fields are required.");
		} else if (strlen($zipcode) != 5) {
			array_push($errors, "Invalid zipcode.");
		} else if (strlen($password_1) < 8) {
			array_push($errors, "Password is too short");
		} else if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match");
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
			$query = "call manager_only_register('$username', '$password', '$fname', '$lname', '$company', '$street', '$city', '$state', '$zipcode')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: 9 manager only functionality.php');
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
		//$cred_num    = mysqli_real_escape_string($db, $_POST['cred_num']);

		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);

		// ALL fields are required
		// Check if user is already registered
		if (mysqli_num_rows($results) == 1) {
			array_push($errors, "You already have an account.");
		} else if (empty($username) || empty($fname) || empty($lname) ||
					empty($password_1) || empty($company) || empty($state) ||
					empty($street) || empty($city) || empty($zipcode)) {
			array_push($errors, "All fields are required.");
		} else if (strlen($zipcode) != 5) {
			array_push($errors, "Invalid zipcode.");
		} else if (strlen($password_1) < 8) {
			array_push($errors, "Password is too short");
		} else if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match");
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
		/*
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
		*/

		// check to see if credit card number is already registered in system
		$number = 0;
		$valid_cred = 0;
		$number = count($_POST["mytext"]);
		if($number > 1)
		{
			for($i=1; $i<$number; $i++)
			{
				$thiscred = trim($_POST["mytext"][$i]) ;
				//echo $thiscred ;
				//echo strlen($thiscred) ;
				if($thiscred == '')
				{
					array_push($errors, "Credit number " . $i . " is blank");
					//echo $i ;
				} else if(strlen($thiscred) != 16) {
					array_push($errors, "Credit number " . $i . " is invalid");
				} else {
					$query = "SELECT creditCardNum FROM creditcard WHERE creditCardNum='$thiscred'";
					$results = mysqli_query($db, $query);
					if (mysqli_num_rows($results) == 1) {
						array_push($errors, "Credit number " . $i . " already exists");
					} else {
						$check_dub = 0;
						for($j=1;$j<$i; $j++) {
							if($thiscred == trim($_POST["mytext"][$j])) {
								$check_dub = $check_dub + 1 ;
							}
						}
						if($check_dub == 0) {
							$valid_cred = $valid_cred + 1;
						} else {
							array_push($errors, "Credit number " . $i . " is duplicated");
						}
					}
				}
			}
		}

		if($valid_cred == 0) {
			array_push($errors, "Please enter at least a valid credit card number!");
		}

		// register customer if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1); //encrypt the password before saving in the database
			// add customer to database
			$password = $password_1;
			$query = "call manager_customer_register('$username', '$password', '$fname', '$lname', '$company', '$street', '$city', '$state', '$zipcode')";
			mysqli_query($db, $query);
			// add credit card number to database
			//$query = "call manager_customer_add_creditcard('$username', '$cred_num')";
			//mysqli_query($db, $query);

			$number = count($_POST["mytext"]);
			for($i=1; $i<$number; $i++)
			{
				$thiscred = trim($_POST["mytext"][$i]) ;
				$query = "call customer_add_creditcard('$username', '$thiscred')";
				mysqli_query($db, $query);
			}


			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: 10 manager customer functionality.php');
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

		$query = "SELECT * FROM user WHERE username='$username'";
		$results = mysqli_query($db, $query);

		// ALL fields are required
		// Check if user is already registered
		if (mysqli_num_rows($results) == 1) {
			array_push($errors, "You already have an account.");
		} else if (empty($username) || empty($fname) || empty($lname) || empty($password_1)) {
			array_push($errors, "All fields are required.");
		} else if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match.");
		} else if (strlen($password_1) < 8) {
			array_push($errors, "Password is too short.");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1); //encrypt the password before saving in the database
			$password = $password_1 ;
			$query = "call user_register('$username', '$password', '$fname', '$lname')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";

			header('location: 12 user functionality.php');

		}

	}

	if (isset($_POST['logout-button'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: 1 login.php");
    }


	// ...

	// APPROVE USER
	if (isset($_POST['approve_user'])) {
		if(isset($_POST['radAnswer'])) {
			$chosenuser = $_POST['radAnswer'];



			$query = "call admin_approve_user('$chosenuser')";
			mysqli_query($db, $query);
		} else {
			array_push($errors, "You must select a user to approve");
		}
	}

	// DECLINE USER
	if (isset($_POST['decline_user'])) {
		if(isset($_POST['radAnswer'])) {
			$chosenuser = $_POST['radAnswer'];

			$query = "SELECT status FROM user WHERE username = '$chosenuser'" ;
			$thisstat = mysqli_query($db, $query);
			$thisrowstat = mysqli_fetch_array($thisstat) ;
			if($thisrowstat[0] == 'Approved') {
				array_push($errors, "You cannot decline this user");

			} else {
				$query = "call admin_decline_user('$chosenuser')";
				mysqli_query($db, $query);

			}


		} else {
			array_push($errors, "You must select a user to decline");
		}
	}

 	//manage company
	if (isset($_POST['company_detail'])) {
		if(!isset($_POST['radcomp'])) {
			array_push($errors, "Please choose a company!");
		}
		if (count($errors) == 0) {
			$detailcomp = $_POST['radcomp'] ;
			$_SESSION['detailcomp'] = $detailcomp;
			header('location: 16 admin company detail.php');

		}

	}

		// back to registration navigation screen
	 if (isset($_POST['reg_back'])) {
		 header('location: 2 registration navigation.php');
	 }

	  // back to fucntionality screens
	  if (isset($_POST['my-back-button'])) {
		  if (!isset($_SESSION['username'])) {
			  $_SESSION['msg'] = "You must log in first";
			  header('location: 1 login.php');
		  }
		  $username = $_SESSION['username'];
		  $query = "call get_userType('$username')";
		  mysqli_query($db, $query);
		  $query = "SELECT userType FROM user_type WHERE username='$username'";
		  $thistype = "" ;
		  $thistype = mysqli_query($db, $query);
		  $thisrow = mysqli_fetch_array($thistype) ;
		  echo $thisrow[0];
		  if ($thisrow[0] == "CustomerManager") {
			  header('location: 10 manager customer functionality.php');

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
		  }
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
		$query = "SELECT status FROM user WHERE username = '$username'" ;
		$thisstat = mysqli_query($db, $query);
		$thisrowstat = mysqli_fetch_array($thisstat) ;
		if($thisrowstat[0] == 'Declined') {
			array_push($errors, "You are a declined user!");

		}

		if (count($errors) == 0) {
			//echo $password;
			$password = md5($password);
			//echo $password;
			$query = "call get_userType('$username')";
			mysqli_query($db, $query);
			$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
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
				} else {
					header('location: 12 user functionality.php');
				}

			} else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>
