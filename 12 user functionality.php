<?php include('server.php');

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: 1 login.php');
    }

    if (isset($_GET['logout-button'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: 1 login.php");
    }

    $username = $_SESSION['username'];

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Functionality</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>User Functionality</h2>
	</div>

	<form method="post" action="7 admin only functionality.php">

		<p>
			<a href="22 user explore theater.php">Explore Theather</a> <br />
			<a href="23 user visit history.php">Visit History</a> <br />
			<button class = 'btn' name = "logout-button">Back</button>
		</p>
	</form>

</body>
</html>
