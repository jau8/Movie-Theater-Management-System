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
.date label {
  align-items: center;
}

.date span::after {
  padding-left: 5px;
}

.date input {
    display: inline;
    height: 30px;
	width: 35%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}

.date input:invalid + span::after {
  content: '✖';
}

.date input:valid+span::after {
  content: '✓';
}
</style>
<head>
	<title>User Explore Theater</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Explore Theater</h2>
	</div>



	<form method="post" action="22 user explore theater.php">

        <?php include('errors.php'); ?>

        <div class="input-group">
            <label>Theater Name</label>
            <select class="select-css" type="text" name="theater_name" value="<?php echo $theater_name; ?>">
                <?php
                $comquery = "SELECT * FROM theater";
                $comsql = mysqli_query($db, $comquery);
                $colsql = "thName" ;
                while ($row = mysqli_fetch_array($comsql)) {
                    echo "<option>$row[$colsql]</option>";
                }
                 ?>
            </select>
        </div>

        <div class="input-group">
            <label>Company Name</label>
            <select class="select-css" type="text" name="company" value="<?php echo $company; ?>">
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
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>

        <div class="input-group">
			<label>State</label>
			<select class="select-css" type="text" name="state" value="<?php echo $state; ?>">
				<option value="AL"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Alabama</option>
				<option value="AK"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Alaska</option>
				<option value="AZ"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Arizona</option>
				<option value="AR"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Arkansas</option>
				<option value="CA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>California</option>
				<option value="CO"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Colorado</option>
				<option value="CT"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Connecticut</option>
				<option value="DE"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Delaware</option>
				<option value="DC"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>District Of Columbia</option>
				<option value="FL"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Florida</option>
				<option value="GA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Georgia</option>
				<option value="HI"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Hawaii</option>
				<option value="ID"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Idaho</option>
				<option value="IL"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Illinois</option>
				<option value="IN"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Indiana</option>
				<option value="IA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Iowa</option>
				<option value="KS"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Kansas</option>
				<option value="KY"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Kentucky</option>
				<option value="LA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Louisiana</option>
				<option value="ME"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Maine</option>
				<option value="MD"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Maryland</option>
				<option value="MA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Massachusetts</option>
				<option value="MI"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Michigan</option>
				<option value="MN"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Minnesota</option>
				<option value="MS"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Mississippi</option>
				<option value="MO"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Missouri</option>
				<option value="MT"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Montana</option>
				<option value="NE"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Nebraska</option>
				<option value="NV"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Nevada</option>
				<option value="NH"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>New Hampshire</option>
				<option value="NJ"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>New Jersey</option>
				<option value="NM"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>New Mexico</option>
				<option value="NY"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>New York</option>
				<option value="NC"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>North Carolina</option>
				<option value="ND"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>North Dakota</option>
				<option value="OH"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Ohio</option>
				<option value="OK"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Oklahoma</option>
				<option value="OR"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Oregon</option>
				<option value="PA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Pennsylvania</option>
				<option value="RI"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Rhode Island</option>
				<option value="SC"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>South Carolina</option>
				<option value="SD"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>South Dakota</option>
				<option value="TN"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Tennessee</option>
				<option value="TX"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Texas</option>
				<option value="UT"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Utah</option>
				<option value="VT"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Vermont</option>
				<option value="VA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Virginia</option>
				<option value="WA"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Washington</option>
				<option value="WV"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>West Virginia</option>
				<option value="WI"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Wisconsin</option>
				<option value="WY"<?php if (isset($_POST['state'])) echo 'selected="selected"'; ?>>Wyoming</option>
		  </select>
		</div>



          <button class = 'btn' name = "filter_visit">Filter</button>

          <?php
              if (isset($_POST['filter_visit'])) {
                  echo '<table id="table" table align="center">
          		  <tr class="header">
          		    <th style="width:20%;"><a>Theater</a></th>
                      <th style="width:25%;"><a>Address</a></th>
                      <th style="width:15%;"><a>Company</a></th>
          		  </tr>';

                  $username = $_SESSION['username'];
                  $theater_name = $_POST['theater_name'];
                  $company = $_POST['company'];
                  $city = $_POST['city'];
                  $state = $_POST['state'];

                  $comquery = "call user_filter_th('$theater_name', '$company', '$city', '$state')";
                  $comsql = mysqli_query($db, $comquery);

                 // echo $company;
                  $comquery = "SELECT * FROM  UserFilterTh";
                  //thName, thStreet, thCity, thState, thZipcode, comName
                  $comsql = mysqli_query($db, $comquery);
                  while ($row = mysqli_fetch_assoc($comsql)) {
                      echo "<tr>" ;
                      echo "<td><input type='radio' name='radvis' id = 'radvis' value='" .$row["thName"]. "[" .$row["comName"]. "'/>" .$row["thName"]."</td>" ;
                      echo     "<td>".$row["thStreet"]."</td>
                                <td>".$row["comName"]."</td>
                            </tr>";
                  }
                  echo "</table>";
              }
          ?>

		</table>

        <div class="date" >
            <label>Visit Date: </label>
            <input name="visit_date" type="date" value="<?php echo $visit_date; ?>">
        </div>


        <p>
			<button class = 'btn' name = "log-visit">Log Visit</button>
        </p>

        <p>
			<button class = 'btn' name = "my-back-button">Back</button>

		</p>

	</form>

</body>
</html>
