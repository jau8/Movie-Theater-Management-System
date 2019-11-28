<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function(e) {
		var max_fields      = 5; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++ ;//text box increment
				$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
			}
		});

		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});
</script>
<style>
	.input_fields_wrap {
		margin: 10px 0px 10px 0px;
	}
	.input_fields_wrap label {
		display: block;
		text-align: left;
		margin: 3px;
	}
	.input_fields_wrap input {
		height: 30px;
		width: 50%;
		padding: 5px 10px;
		font-size: 16px;
		border-radius: 5px;
		border: 1px solid gray;
	}
	.add_field_button {
		padding: 10px;
		font-size: 15px;
		color: white;
		background: #5F9EA0;
		border: none;
		border-radius: 5px;
		float: right;
		margin: 0px 20px 0px 10px;
	}
	.remove_field {
		float: right;
		margin: 18px 0px 0px 0px;
	}
</style>
<head>
	<title>Customer Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Customer Registration</h2>
	</div>

	<form method="post" action="4 customer registration.php">

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


		<div class="input_fields_wrap" id="cred_num">
			<label>Credit Card Number</label>
		    <button class="add_field_button" name="add_cred">Add</button>
		    <div><input type="text" name="mytext[]"></div>
		</div>


		<div class="input-group">
			<button type="submit" class="btn" name="reg_customer">Register</button>
		</div>
		<p>
			Already a member? <a href="1 login.php">Sign in</a>
		</p>
	</form>
</body>
</html>
