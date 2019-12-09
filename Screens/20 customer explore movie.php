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
<script>
	var dateControl = document.querySelector('input[type="date"]');
	dateControl.value = '2019-12-01';
	//console.log(dateControl.value); // prints "2017-06-01"
	//console.log(dateControl.valueAsNumber); // prints 1496275200000, a UNIX timestamp
</script>
<style>
.date label {
  display: flex;
  align-items: center;
}

.date span::after {
  padding-left: 5px;
}

.date input {
    display: inline;
    height: 30px;
	width: 30%;
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
table {
    text-align: center;
}
form {
    align-content: center;
}

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
	<title>Customer Explore Movie</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Explore Movie</h2>
	</div>
	<form method="post" action="20 customer explore movie.php">

        <?php include('errors.php'); ?>

        <div class="input-group">
			<label>Movie Name</label>
			<select class="select-css" type="text" name="movie_name">
				<?php
				$comquery = "SELECT movName FROM movie";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "movName" ;
                echo "<option value = '$manuser'>ALL</option>";
				while ($row = mysqli_fetch_array($comsql)) {
					$manuser = $row["movName"] ; // value that get passed over to server
					echo "<option value = '$manuser'>$row[$colsql]</option>";
				}
				 ?>
			</select>
		</div>

        <div class="input-group">
			<label>Company</label>
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
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>

        <div class="input-group">
			<label>State</label>
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

        <div class="date" >
			<label>Mininum Date</label>
			<input name="min_date" type="date" value="<?php echo $min_date; ?>">
            <label>Maximum Date</label>
			<input name="max_date" type="date" value="<?php echo $max_date; ?>">
		</div>

        <div class="input-group">
              <button type="submit" class="btn" name="filter_movie">Filter</button>
  		</div>

          <?php
          if (isset($_POST['filter_movie'])) { // filter button
              $movie_name  = (!empty($_POST['movie_name'])) ? $movie_name = $_POST['movie_name']:$movie_name='';
              $company  = (!empty($_POST['company'])) ? $company = $_POST['company']:$company='';
              $state  = (!empty($_POST['state'])) ? $state = $_POST['state']:$state='';
              $min_date  = (!empty($_POST['min_date'])) ? $min_date = $_POST['min_date']:$min_date='0000-01-01';
              $max_date  = (!empty($_POST['max_date'])) ? $max_date = $_POST['max_date']:$max_date='9999-01-01';

              $city = '';
              $city  = (!empty($_POST['city'])) ? $city = $_POST['city']:$city='';

             // echo $movie_name;
             // echo $company;
              //echo $state;
              //echo $min_date;
              //echo $max_date;

              if (count($errors) == 0) {

                  echo '<table id="table" table align="center">';
          		  echo '<tr class="header">';
          		  echo '  <th style="width:20%;"><a>Movie</a></th>';
                  echo '<th style="width:20%;"><a>Theater</a></th>';
                  echo '  <th style="width:30%;"><a>Address</a></th>';
          		  echo '  <th style="width:15%;"><a>Company</a></th>';
                  echo '      <th style="width:20%;"><a>Play Date</a></th>';
          		  echo '</tr>';

                  $comquery = "call customer_filter_mov('$movie_name', '$company', '$city', '$state', '$min_date', '$max_date')";
                  $comsql = mysqli_query($db, $comquery);


                  $comquery = "SELECT * FROM cosfiltermovie";
                  $comsql = mysqli_query($db, $comquery);
                  while ($row = mysqli_fetch_assoc($comsql)) {
                      echo "<tr id='" .$row["movName"]. " " .$row["movReleaseDate"]. "'>" ;
                      echo "<td><input type='radio' name='radmov' id = 'radAnswer' value='" .$row["movName"]. "[" .$row["movReleaseDate"]. "[" .$row["thName"]. "[" .$row["comName"]. "[" .$row["movPlayDate"]. "'/>" .$row['movName']. "</td>" ;
                      echo "
                                <td>".$row["thName"]."</td>
                                <td>".$row["thStreet"].", ".$row["thCity"].", ".$row["thState"]."</td>
                                <td>".$row["comName"]."</td>
                                <td>".$row["movPlayDate"]."</td>
                                <td>" ."<input type='hidden'" .$row["movReleaseDate"]."</td>
                            </tr>";
                  }
                  echo "</table>";
              }
          }
          ?>

		</table>

        <div class="input-group">
			<label>Credit Card Number</label>
			<select class="select-css" type="text" name="this_cred_num">
				<?php
				$comquery = "SELECT * FROM creditcard WHERE username = '$username'";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "creditCardNum" ;
				while ($row = mysqli_fetch_array($comsql)) {
					echo "<option>$row[$colsql]</option>";
				}
				 ?>
	  		</select>
		</div>

        <div class="input-group">
              <button type="submit" class="btn" name="view_movie">View</button>

              <?php
              /*
              if (isset($_POST['view_movie'])) {
                  if(isset($_POST['radmov'])) {
                      $movkey = $_POST['radmov'];
                      list($thismovname, $thismovdate) = explode(' ', $movkey);
                      $comquery = "SELECT * FROM cosfiltermovie WHERE movName = '$thismovname' AND movReleaseDate = '$thismovdate' ";
                      $comsql = mysqli_query($db, $comquery);
                      $thismovrow = mysqli_fetch_array($comsql) ;
                      $thiscredit = isset($_POST['this_cred_num']) ? $thiscredit = $_POST['this_cred_num'] : $thiscredit = '' ;
                      echo $thismovrow[0] ." " .$thismovrow[8] ." " .$thismovrow[1] ." " .$thismovrow[6] ." " .$thismovrow[7] ." " .$thiscredit;
                  } else {
                      array_push($errors, "You must select movie to view");
                  }

              }
              */
              ?>
  		</div>

        <p>
			<button class = 'btn' name = "this-back-button">Back</button>
            <?php

             ?>

		</p>

	</form>

</body>
</html>
