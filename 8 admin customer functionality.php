<?php include('server.php') ;

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: 1 login.php');
    }

    if (isset($_GET['logout-button'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: 1 login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-Customer Functionality</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Admin-Customer Functionality</h2>
	</div>

	<form method="post" action="8 admin customer functionality.php">

		<p>
			<a href="13 admin manage user.php">Manage User</a> <br />
			<a href="14 admin manage company.php">Manage Company</a> <br />
			<a href="17 admin create movie.php">Create Movie</a> <br />
			<a href="20 customer explore movie.php">Explore Movie</a> <br />
			<a href="21 customer view history.php">View History</a> <br />
			<a href="22 user explore theater.php">Explore Theather</a> <br />
			<a href="23 user visit history.php">Visit History</a> <br />
			<button class = 'btn' name = "logout-button">Back</button>
		</p>
	</form>

</body>
</html>
