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

    $username = $_SESSION['username'];

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer View History</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>View History</h2>
	</div>

	<form method="post" action="21 customer view history.php">

        <div class="date" >
			<label>Mininum Date</label>
			<input name="min_date" type="date" value="<?php echo $min_date; ?>">
            <label>Maximum Date</label>
			<input name="max_date" type="date" value="<?php echo $max_date; ?>">
		</div>

        <table id="table" table align="center">
		  <tr class="header">
		    <th style="width:20%;"><a>Movie</a></th>
            <th style="width:20%;"><a>Theater</a></th>
            <th style="width:15%;"><a>Company</a></th>
		    <th style="width:30%;"><a>Card Number</a></th>
            <th style="width:20%;"><a>View Date</a></th>
		  </tr>

          <?php
              $comquery = "call customer_view_history('$username')";
              $comsql = mysqli_query($db, $comquery);
              //echo $username;

              $comquery = "SELECT * FROM cosviewhistory";
              $comsql = mysqli_query($db, $comquery);
              while ($row = mysqli_fetch_assoc($comsql)) {
                  echo "<tr>" ;
                  echo "
                            <td>".$row["movName"]."</td>
                            <td>".$row["thName"]."</td>
                            <td>".$row["comName"]."</td>
                            <td>".$row["creditCardNum"]."</td>
                            <td>".$row["movPlayDate"]."</td>
                        </tr>";
              }
              echo "</table>";
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
