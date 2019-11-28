<?php include('server.php');
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: 1 login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: 1 login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-Only Functionality</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Admin-Only Functionality</h2>
	</div>

	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
	</div>

	<form method="post" action="7 admin only functionality.php">

		<p>
			<a href="13 admin manage user.php">Manage User</a> <br />
			<a href="14 admin manage company.php">Manage Company</a> <br />
			<a href="17 admin create movie.php">Create Movie</a> <br />
			<a href="22 user explore theather.php">Explore Theather</a> <br />
			<a href="23 user visit history.php">Visit History</a> <br />
			<a href="1 login.php">Back</a>
		</p>
	</form>

</body>
</html>
