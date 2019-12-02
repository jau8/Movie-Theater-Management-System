<?php include('server.php');

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
  margin: 3px;
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
	<title>User Visit History</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Visit History</h2>
	</div>



	<form method="post" action="23 user visit history.php">

        <div class="input-group">
            <label>Company</label>
            <select class="select-css" type="text" name="visitcompany" value="<?php echo $visitcompany; ?>">
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

        <div class="date" >
            <label>Visit Date: </label>
            <input name="min_date" type="date" value="<?php echo $min_date; ?>">
            <label> -- </label>
            <input name="max_date" type="date" value="<?php echo $max_date; ?>">
        </div>

        <table id="table" table align="center">
		  <tr class="header">
		    <th style="width:20%;"><a>Theater</a></th>
            <th style="width:25%;"><a>Address</a></th>
            <th style="width:15%;"><a>Company</a></th>
            <th style="width:20%;"><a>Visit Date</a></th>
		  </tr>

          <button class = 'btn' name = "filter_visit">Filter</button>

          <?php
              if (isset($_POST['filter_visit'])) {
                  $username = $_SESSION['username'];
                  $min_date  = (!empty($_POST['min_date'])) ? $min_date = $_POST['min_date']:$min_date='0000-01-01';
                  $max_date  = (!empty($_POST['max_date'])) ? $max_date = $_POST['max_date']:$max_date='9999-01-01';
                  $comquery = "call user_filter_visitHistory('$username', '$min_date', '$max_date')";
                  $comsql = mysqli_query($db, $comquery);
                  $thiscomp = "" ;
                  $thiscomp = (!empty($_POST['visitcompany'])) ? $thiscomp = $_POST['visitcompany'] : $thiscomp = '';
                  $comquery = "SELECT * FROM UserVisitHistory WHERE comName = '$thiscomp'";
                  $comsql = mysqli_query($db, $comquery);
                  while ($row = mysqli_fetch_assoc($comsql)) {
                      echo "<tr>" ;
                      echo "
                                <td>".$row["thName"]."</td>
                                <td>".$row["thStreet"]."</td>
                                <td>".$row["comName"]."</td>
                                <td>".$row["visitDate"]."</td>
                            </tr>";
                  }
                  echo "</table>";
              }
          ?>

		</table>

        <p>
			<button class = 'btn' name = "this-back-button">Back</button>
            <?php
            /*
                if (isset($_POST['back-button'])) {
                    $query = "SELECT userType FROM user_type WHERE username='$username'";
                    $thistype = "" ;
                    $thistype = mysqli_query($db, $query);
                    $thisrow = mysqli_fetch_array($thistype) ;
                    echo $thisrow[0];
                    if ($thisrow[0] == "CustomerManager") {
                        header('location: 10 manager customer functionality.php');

                    } else if ($thisrow[0] == "CustomerAdmin") {
                        header('location: 8 admin customer functionality.php');
                    } else if ($thisrow[0] == "Admin") {
                        header('location: 7 admin only functionality.php');
                    } else if ($thisrow[0] == "Manager") {
                        header('location: 9 manager only functionality.php');
                    } else if ($thisrow[0] == "Customer") {
                        header('location: 11 customer functionality.php');
                    } else if ($thisrow[0] == "User") {
                        header('location: 12 user functionality.php');
                    } else {
                        header('location: index.php');
                    }
                }
                */
             ?>

		</p>

	</form>

</body>
</html>
