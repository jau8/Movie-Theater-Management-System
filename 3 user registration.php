<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>User Registration</h2>
	</div>

	<form method="post" action="3 user registration.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>First Name </label>
			<input type="text" name="fname" value="<?php echo $fname; ?>">
			<label>Last Name </label>
			<input type="text" name="lname" value="<?php echo $lname; ?>">
		</div>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>

		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
			<button class="btn" name="reg_back">Back</button>
		</div>
		<p>
			Already a member? <a href="1 login.php">Sign in</a>
		</p>
	</form>
</body>
</html>
