<?php include('server.php') ;
	$state = isset($_POST["state"]) ? $_POST["state"] : '';
?>
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
			var clone = $(".faculty_row").eq(0).clone();
			var removeLink = '<a href="#" cclass="remove_field">Remove</a>';
			if(x < max_fields){ //max input box allowed
				//$(".faculty_row").append(clone);
				//$(".faculty_row").append(removeLink);
				var bla = $('#parent_cred').val();
				if((!$.isNumeric(bla)) || (bla.length != 16)) {
					alert('Credit card is invalid.');
				} else {
					//alert('Credit card is. ' + $.type($bla) ' length');
					x++ ;//text box increment
					$(wrapper).append('<div><input type="text" name="mytext[]" value="' + bla + '" readonly ="readonly"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
					$('#parent_cred').val('');
				}
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
.select-css {
	display: block;
	font-size: 15px;
	padding: 10px 10px;
	width: 97%;
	box-sizing: border-box;
	font-size: 16px;
	margin: 10px 0px 10px 0px;
	border-radius: 5px;
	border: 1px solid gray;
}
</style>
<head>
	<title>Manager-Customer Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Manager-Customer Registration</h2>
	</div>

	<form method="post" action="6 manager customer registration.php">

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
			<label>Company</label>
		</div>
		</div>
			<select class="select-css" type="text" name="company">
				<?php
				$comquery = "SELECT * FROM company";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "comName" ;
				while ($row = mysqli_fetch_array($comsql)) {
					echo "<option>$row[$colsql]</option>";
				}
				 ?>
	  		</select>
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
			<label>Street Address</label>
			<input type="text" name="street" value="<?php echo $street; ?>">
		</div>
        <div class="input-group">
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>
		<div class="input-group">
			<label>State</label>
		</div>
			<select class="select-css" type="text" name="state" value="<?php echo isset($_POST["state"]) ? $_POST["state"] : ''; ?>">
				<option value="AL" <?php if (isset($_POST['state']) && $_POST['state'] == 'AL') echo 'selected="selected"'; ?>>Alabama</option>
				<option value="AK"<?php if (isset($_POST['state']) && $_POST['state'] == 'AK') echo 'selected="selected"'; ?>>Alaska</option>
				<option value="AZ" <?php if (isset($_POST['state']) && $_POST['state'] == 'AZ') echo 'selected="selected"'; ?>>Arizona</option>
				<option value="AR"<?php if (isset($_POST['state']) && $_POST['state'] == 'AR') echo 'selected="selected"'; ?>>Arkansas</option>
				<option value="CA" <?php if (isset($_POST['state']) && $_POST['state'] == 'CA') echo 'selected="selected"'; ?>>California</option>
				<option value="CO"<?php if (isset($_POST['state']) && $_POST['state'] == 'CO') echo 'selected="selected"'; ?>>Colorado</option>
				<option value="CT"<?php if (isset($_POST['state']) && $_POST['state'] == 'CT') echo 'selected="selected"'; ?>>Connecticut</option>
				<option value="DE"<?php if (isset($_POST['state']) && $_POST['state'] == 'DE') echo 'selected="selected"'; ?>>Delaware</option>
				<option value="DC"<?php if (isset($_POST['state']) && $_POST['state'] == 'DC') echo 'selected="selected"'; ?>>District Of Columbia</option>
				<option value="FL"<?php if (isset($_POST['state']) && $_POST['state'] == 'FL') echo 'selected="selected"'; ?>>Florida</option>
				<option value="GA"<?php if (isset($_POST['state']) && $_POST['state'] == 'GA') echo 'selected="selected"'; ?>>Georgia</option>
				<option value="HI"<?php if (isset($_POST['state']) && $_POST['state'] == 'HI') echo 'selected="selected"'; ?>>Hawaii</option>
				<option value="ID"<?php if (isset($_POST['state']) && $_POST['state'] == 'ID') echo 'selected="selected"'; ?>>Idaho</option>
				<option value="IL"<?php if (isset($_POST['state']) && $_POST['state'] == 'IL') echo 'selected="selected"'; ?>>Illinois</option>
				<option value="IN"<?php if (isset($_POST['state']) && $_POST['state'] == 'IN') echo 'selected="selected"'; ?>>Indiana</option>
				<option value="IA"<?php if (isset($_POST['state']) && $_POST['state'] == 'IA') echo 'selected="selected"'; ?>>Iowa</option>
				<option value="KS"<?php if (isset($_POST['state']) && $_POST['state'] == 'KS') echo 'selected="selected"'; ?>>Kansas</option>
				<option value="KY"<?php if (isset($_POST['state']) && $_POST['state'] == 'KY') echo 'selected="selected"'; ?>>Kentucky</option>
				<option value="LA"<?php if (isset($_POST['state']) && $_POST['state'] == 'LA') echo 'selected="selected"'; ?>>Louisiana</option>
				<option value="ME"<?php if (isset($_POST['state']) && $_POST['state'] == 'ME') echo 'selected="selected"'; ?>>Maine</option>
				<option value="MD"<?php if (isset($_POST['state']) && $_POST['state'] == 'MD') echo 'selected="selected"'; ?>>Maryland</option>
				<option value="MA"<?php if (isset($_POST['state']) && $_POST['state'] == 'MA') echo 'selected="selected"'; ?>>Massachusetts</option>
				<option value="MI"<?php if (isset($_POST['state']) && $_POST['state'] == 'MI') echo 'selected="selected"'; ?>>Michigan</option>
				<option value="MN"<?php if (isset($_POST['state']) && $_POST['state'] == 'MN') echo 'selected="selected"'; ?>>Minnesota</option>
				<option value="MS"<?php if (isset($_POST['state']) && $_POST['state'] == 'MS') echo 'selected="selected"'; ?>>Mississippi</option>
				<option value="MO"<?php if (isset($_POST['state']) && $_POST['state'] == 'MO') echo 'selected="selected"'; ?>>Missouri</option>
				<option value="MT"<?php if (isset($_POST['state']) && $_POST['state'] == 'MT') echo 'selected="selected"'; ?>>Montana</option>
				<option value="NE"<?php if (isset($_POST['state']) && $_POST['state'] == 'NE') echo 'selected="selected"'; ?>>Nebraska</option>
				<option value="NV"<?php if (isset($_POST['state']) && $_POST['state'] == 'NV') echo 'selected="selected"'; ?>>Nevada</option>
				<option value="NH"<?php if (isset($_POST['state']) && $_POST['state'] == 'NH') echo 'selected="selected"'; ?>>New Hampshire</option>
				<option value="NJ"<?php if (isset($_POST['state']) && $_POST['state'] == 'NJ') echo 'selected="selected"'; ?>>New Jersey</option>
				<option value="NM"<?php if (isset($_POST['state']) && $_POST['state'] == 'NM') echo 'selected="selected"'; ?>>New Mexico</option>
				<option value="NY"<?php if (isset($_POST['state']) && $_POST['state'] == 'NY') echo 'selected="selected"'; ?>>New York</option>
				<option value="NC"<?php if (isset($_POST['state']) && $_POST['state'] == 'NC') echo 'selected="selected"'; ?>>North Carolina</option>
				<option value="ND"<?php if (isset($_POST['state']) && $_POST['state'] == 'ND') echo 'selected="selected"'; ?>>North Dakota</option>
				<option value="OH"<?php if (isset($_POST['state']) && $_POST['state'] == 'OH') echo 'selected="selected"'; ?>>Ohio</option>
				<option value="OK"<?php if (isset($_POST['state']) && $_POST['state'] == 'OK') echo 'selected="selected"'; ?>>Oklahoma</option>
				<option value="OR"<?php if (isset($_POST['state']) && $_POST['state'] == 'OR') echo 'selected="selected"'; ?>>Oregon</option>
				<option value="PA"<?php if (isset($_POST['state']) && $_POST['state'] == 'PA') echo 'selected="selected"'; ?>>Pennsylvania</option>
				<option value="RI"<?php if (isset($_POST['state']) && $_POST['state'] == 'RI') echo 'selected="selected"'; ?>>Rhode Island</option>
				<option value="SC"<?php if (isset($_POST['state']) && $_POST['state'] == 'SC') echo 'selected="selected"'; ?>>South Carolina</option>
				<option value="SD"<?php if (isset($_POST['state']) && $_POST['state'] == 'SD') echo 'selected="selected"'; ?>>South Dakota</option>
				<option value="TN"<?php if (isset($_POST['state']) && $_POST['state'] == 'TN') echo 'selected="selected"'; ?>>Tennessee</option>
				<option value="TX"<?php if (isset($_POST['state']) && $_POST['state'] == 'TX') echo 'selected="selected"'; ?>>Texas</option>
				<option value="UT"<?php if (isset($_POST['state']) && $_POST['state'] == 'UT') echo 'selected="selected"'; ?>>Utah</option>
				<option value="VT"<?php if (isset($_POST['state']) && $_POST['state'] == 'VT') echo 'selected="selected"'; ?>>Vermont</option>
				<option value="VA"<?php if (isset($_POST['state']) && $_POST['state'] == 'VA') echo 'selected="selected"'; ?>>Virginia</option>
				<option value="WA"<?php if (isset($_POST['state']) && $_POST['state'] == 'WA') echo 'selected="selected"'; ?>>Washington</option>
				<option value="WV"<?php if (isset($_POST['state']) && $_POST['state'] == 'WV') echo 'selected="selected"'; ?>>West Virginia</option>
				<option value="WI"<?php if (isset($_POST['state']) && $_POST['state'] == 'WI') echo 'selected="selected"'; ?>>Wisconsin</option>
				<option value="WY"<?php if (isset($_POST['state']) && $_POST['state'] == 'WY') echo 'selected="selected"'; ?>>Wyoming</option>
		  </select>
		</div>
        <div class="input-group" type="text" value="<?php echo $username; ?>">
			<label>Zipcode</label>
			<input type="text" name="zipcode">
		</div>

		<div class="input_fields_wrap" id="cred_num">
			<label>Credit Card Number</label>
		    <button class="add_field_button" name="add_cred">Add</button>
		    <div class="faculty_row"><input type="text" name="mytext[]" id="parent_cred"></div>
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="reg_manager_customer">Register</button>
			<button class="btn" name="reg_back">Back</button>
		</div>
		<p>
			Already a member? <a href="1 login.php">Sign in</a>
		</p>
	</form>
</body>
</html>
