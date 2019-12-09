<?php include('server.php') ;

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: 1 login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: 1 login.php");
    }

    $username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html>
<script type="text/javascript">
/*
function get_managers() { // Call to ajax function
    var company = $('#company').val();
    var dataString = "company="+company;
    alert(company) ;
    $.ajax({
        type: "POST",
        url: "getmanagers.php", // Name of the php files
        data: dataString,
        success: function(html)
        {
            $("#manager").html(html);
        }
    });
}


$(document).ready(function(){
    $("#company").change(function(){
        var company = $("#company").val();
        alert(company) ;
        $.ajax({
            type: "POST",
            url: "getmanagers.php",
            data: { company : company }
        }).done(function(data){
            $("#manager").html(data);
        });
    });
});
*/
</script>
<style>
.select-css {
	display: block;
	font-size: 15px;
	padding: 10px 10px;
	width: 95%;
	box-sizing: border-box;
	font-size: 16px;
	margin: 10px 0px 10px 0px;
	border-radius: 5px;
	border: 1px solid gray;
}
</style>
<head>
	<title>Admin Create Theater</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Create Theater</h2>
	</div>

	<form method="post" action="15 admin create theater.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="theater_name" value="<?php echo $theater_name; ?>">
		</div>
		<div class="input-group">
			<label>Company</label>
			<select class="select-css" type="text" name="company" id="company" value="<?php echo $company; ?>" >
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
			<select class="select-css" type="text" name="state" value="<?php echo $state; ?>">
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
		<div class="input-group" type="number" value="<?php echo $capacity; ?>">
			<label>Capacity</label>
			<input type="text" name="capacity">
		</div>

		<div class="input-group">
			<label>Manager</label>
			<select class="select-css" type="text" name="manager" id="manager">
				<?php
                //$thiscomm = isset($_POST['company']) ? $thiscomm = $_POST['company'] : '' ;
                //echo $_POST['company'] ; WHERE comName = '$thiscomm'

				$comquery = "SELECT username, firstname, lastname FROM user
				WHERE username IN (SELECT username FROM manager)
				AND username NOT IN (SELECT manager FROM theater)";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "firstname" ;
				$colsql2 = "lastname" ;
				while ($row = mysqli_fetch_array($comsql)) {
					$manuser = $row["username"] ;
					echo "<option value = '$manuser'>$row[$colsql] $row[$colsql2]</option>";
				}



				 ?>
             </select>

		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="create_theater" >Create</button>
		</div>


		<p>
			<a href="14 admin manage company.php">Back</a>
		</p>
	</form>

</body>
</html>
