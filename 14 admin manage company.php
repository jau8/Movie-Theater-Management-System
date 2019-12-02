<?php include('server.php') ;
	if(isset($_GET['order'])) {
		$order = $_GET['order'] ;
	} else {
		$order = 'comName' ;
	}
	$sort = isset($_GET['sort']) && strtolower($_GET['sort']) == 'desc' ? 'DESC' : 'ASC';


	$asc_or_desc = $sort == 'ASC' ? 'desc' : 'asc';


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
<style>
.select-css {
	display: inline;
	font-size: 15px;
	padding: 10px 10px;
	width: 97%;
	box-sizing: border-box;
	font-size: 16px;
	margin: 10px 0px 10px 0px;
	border-radius: 5px;
	border: 1px solid gray;
}
.other {
	margin: 10px 0px 10px 0px;
}
.other label {
  align-items: center;
}
.other input {
    display: inline;
    height: 30px;
	width: 20%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;

}
</style>
<head>
	<title>Admin Manage Company</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Manage Company</h2>
	</div>
	<form method="post" action="14 admin manage company.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Company Name</label>
			<select class="select-css" type="text" name="company">
				<?php
				$comquery = "SELECT * FROM company";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "comName" ;
				echo "<option>ALL</option>";
				while ($row = mysqli_fetch_array($comsql)) {
					echo "<option>$row[$colsql]</option>";
				}
				 ?>
	  		</select>
		</div>
		<div class="other" >
            <label>City Covered: </label>
            <input name="min_city" type="number" min="0" value="<?php echo $min_city; ?>">
            <label> -- </label>
            <input name="max_city" type="number" min="0" value="<?php echo $max_city; ?>">
        </div>
		<div class="other" >
            <label># Theaters: </label>
            <input name="min_theater" type="number" min="0" value="<?php echo $min_theater; ?>">
            <label> -- </label>
            <input name="max_theater" type="number" min="0" value="<?php echo $max_theater; ?>">
        </div>
		<div class="other" >
            <label># Employees: </label>
            <input name="min_employee" type="number" min="0" value="<?php echo $min_employee; ?>">
            <label> -- </label>
            <input name="max_employee" type="number" min="0" value="<?php echo $max_employee; ?>">
        </div>
		<div class="input-group">
            <button type="submit" class="btn" name="filter_company">Filter</button>
			<button type="submit" class="btn" name="create_theater_link" style="float: center;">Create Theater</button>
            <button type="submit" class="btn" name="company_detail" style="float: center;">Detail</button>
		</div>

		<?php
			if (isset($_POST['create_theater_link'])) {
				header('location: 15 admin create theater.php');
			}
		 ?>


		<table id="table" table align="center">
		  <tr class="header">
		    <th style="width:20%;"><a href='?order=comName&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>Name</a></th>
            <th style="width:25%;"><a href='?order=numCityCover&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>#CityCovered</a></th>
            <th style="width:15%;"><a href='?order=numTheater&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>#Theaters</a></th>
            <th style="width:20%;"><a href='?order=numEmployee&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>#Employee</a></th>
		  </tr>

          <?php
              if (isset($_POST['filter_company'])) {
				  //if (count($errors) == 0) {


				  if(isset($_POST['company'])) {
	                  $company = $_POST['company'] ;
					  $_SESSION['fourcompany'] = $company;
			  	  }

				  if(!empty($_POST['min_city'])) {
					   $min_city = $_POST['min_city']    ;
					   $_SESSION['fourmin_city'] = $min_city;
				  } else {
					$min_city = 0 ;
				  }

				  if(!empty($_POST['max_city'])) {
					  $max_city = $_POST['max_city'] ;
					  $_SESSION['fourmax_city'] = $max_city;
				  } else {
					  $max_city = 100000 ;
				  }

				  if(!empty($_POST['min_theater'])) {
					  $min_theater = $_POST['min_theater'] ;
					  $_SESSION['fourmin_theater'] = $min_theater;
				  } else {
					  $min_theater = 0 ;
				  }

				  if(!empty($_POST['max_theater'])) {
					  $max_theater = $_POST['max_theater'] ;
					  $_SESSION['fourmax_theater'] = $max_theater;
				  } else {
					  $max_theater = 100000;
				  }

				  if(!empty($_POST['min_employee'])) {
					  $min_employee = $_POST['min_employee'] ;
					  $_SESSION['fourmin_employee'] = $min_employee;
				  } else {
					  $min_employee = 0;
				  }
				  if(!empty($_POST['max_employee'])) {
					  $max_employee = $_POST['max_employee']  ;
					  $_SESSION['fourmax_employee'] = $max_employee;
				  } else {
					  $max_employee = 100000;
				  }

				 // $_SESSION['fourorder'] = $order;
				  //$_SESSION['foursort'] = $sort;
                  //echo $company ." ". $min_city ." ". $max_city ." ". $min_theater ." ". $max_theater ." ". $min_employee ." ". $max_employee ." ". $order ." ". $sort ;
                  //$comquery = "SELECT * FROM company" ;
				  $comquery = "call admin_filter_company('$company', '$min_city', '$max_city', '$min_theater', '$max_theater', '$min_employee', '$max_employee', '$order','$sort')";


                 // $comquery = "SELECT * FROM AdFilterCom";
				  //Output: AdFilterCom (comName, numCityCover, numTheater, numEmployee)
                  $comsql = mysqli_query($db, $comquery);
				  $comquery = "SELECT * FROM adfiltercom ORDER BY $order $sort";
				  $comsql = mysqli_query($db, $comquery);
                  while ($row = mysqli_fetch_assoc($comsql)) {
                      echo "<tr>" ;
					  echo "<td><input type='radio' name='radcomp' id = 'radcomp' value='" .$row["comName"]. "'/>" .$row['comName']. "</td>" ;
                      echo "
                                <td>".$row["numCityCover"]."</td>
                                <td>".$row["numTheater"]."</td>
                                <td>".$row["numEmployee"]."</td>
                            </tr>";

                  }
                  echo "</table>";
              } else {

		                  $company = isset($_SESSION['fourcompany']) ? $company = $_SESSION['fourcompany'] : $company = '';
		                  $min_city = !empty($_SESSION['fourmin_city']) ? $min_city = $_SESSION['fourmin_city'] : $min_city = 0  ;
		  				  $max_city = !empty($_SESSION['fourmax_city']) ? $max_city = $_SESSION['fourmax_city'] : $max_city = 100000;
		  				  $min_theater = !empty($_SESSION['fourmin_theater']) ? $min_theater = $_SESSION['fourmin_theater'] : $min_theater = 0;
		  				  $max_theater = !empty($_SESSION['fourmax_theater']) ? $max_theater = $_SESSION['fourmax_theater'] : $max_theater = 100000;
		  				  $min_employee = !empty($_SESSION['fourmin_employee']) ? $min_employee = $_SESSION['fourmin_employee'] : $min_employee = 0;
		  				  $max_employee = !empty( $_SESSION['fourmax_employee']) ? $max_employee =  $_SESSION['fourmax_employee'] : $max_employee = 100000;

		  				  //$order = !empty($_SESSION['fourorder']) ? $order = $_SESSION['fourorder'] : $order = 'comName';
		  				 // $sort = !empty($_SESSION['foursort']) ? $sort = $_SESSION['foursort'] : $sort = 'ASC';
						  //echo $order ." ". $sort ;
						  //echo $company ." ". $min_city ." ". $max_city ." ". $min_theater ." ". $max_theater ." ". $min_employee ." ". $max_employee ." ". $order ." ". $sort ;
		                   // echo $company ." ". $min_city ." ". $max_city ." ". $min_theater ." ". $max_theater ." ". $min_employee ." ". $max_employee ." ". $order ." ". $sort ;
		                    //$comquery = "SELECT * FROM company" ;
						  //echo $company ." ". $min_city ." ". $max_city ." ". $min_theater ." ". $max_theater ." ". $min_employee ." ". $max_employee ." ". $order ." ". $sort ;
		  				  $comquery = "call admin_filter_company('$company', '$min_city', '$max_city', '$min_theater', '$max_theater', '$min_employee', '$max_employee', '$order','$sort')";


		                   // $comquery = "SELECT * FROM AdFilterCom";
		  				  //Output: AdFilterCom (comName, numCityCover, numTheater, numEmployee)
		                  $comsql = mysqli_query($db, $comquery);
		  				  $comquery = "SELECT * FROM adfiltercom ORDER BY $order $sort";
		  				  $comsql = mysqli_query($db, $comquery);
		                    while ($row = mysqli_fetch_assoc($comsql)) {
		                        echo "<tr>" ;
		  					  echo "<td><input type='radio' name='radcomp' id = 'radcomp' value='" .$row["comName"]. "'/>" .$row['comName']. "</td>" ;
		                        echo "
		                                  <td>".$row["numCityCover"]."</td>
		                                  <td>".$row["numTheater"]."</td>
		                                  <td>".$row["numEmployee"]."</td>
		                              </tr>";

		                    }
		                    echo "</table>";

			  }
          ?>

		</table>

		<p>
			<button class = 'btn' name = "this-back-button">Back</button>
		</p>
	</form>
</body>
</html>
