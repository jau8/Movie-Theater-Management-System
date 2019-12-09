<?php include('server.php');
	$thissixcom = '' ; //company name
	if(isset($_SESSION['detailcomp'])) {
		$thissixcom = $_SESSION['detailcomp'] ;
	}

	;

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
	//echo $thissixcom ;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Company Detail</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Company Detail</h2>
	</div>

	<form method="post" action="16 company detail.php">
		<div class = "input-group">
		<p>
			<strong>Name:</strong> <?php echo $thissixcom;  ?>
		</p>


		<?php
			$comquery = "call admin_view_comDetail_emp('$thissixcom')";
			$comsql = mysqli_query($db, $comquery);
			$comquery = "SELECT * FROM AdComDetailEmp";
			$comsql = mysqli_query($db, $comquery);
			$numrows = mysqli_num_rows($comsql)  ;
			$countrows = 0 ;
			echo "<strong>Employees: </strong>";
			while ($row = mysqli_fetch_assoc($comsql)) {
				if ($countrows == $numrows-1) {
					echo $row['empFirstname'] ." ". $row['empLastname'];
				} else {
					echo $row['empFirstname'] ." ". $row['empLastname']. ", ";
				}

				$countrows = $countrows + 1;
			}



		 ?>
		 </div>

		 <p>
 			 <strong>Theater</strong>
 		</p>

		 <table name = "theater" id="theater" table align="center">
 		  <tr class="header">
 		    <th style="width:20%;"><a>Name</a></th>
			<th style="width:25%;"><a>Manager</a></th>
             <th style="width:25%;"><a>City</a></th>
             <th style="width:15%;"><a>State</a></th>
             <th style="width:20%;"><a>Capacity</a></th>
 		  </tr>

           <?php

			   $comquery = "call  admin_view_comDetail_th('$thissixcom')";
			   $comsql = mysqli_query($db, $comquery);
			   $comquery = "SELECT * FROM AdComDetailTh";
			   $comsql = mysqli_query($db, $comquery);
			   $numrows = mysqli_num_rows($comsql)  ;

			   while ($row = mysqli_fetch_assoc($comsql)) {
                   echo "<tr>" ;
                   echo "
                             <td>".$row["thName"]."</td>
                             <td>".$row["thManagerUsername"]."</td>
                             <td>".$row["thCity"]."</td>
                             <td>".$row["thState"]."</td>
                             <td>".$row["thCapacity"]."</td>
                         </tr>";
               }
               echo "</table>";
           ?>

 		</table>



		<p>
            <a href="14 admin manage company.php">Back</a>
		</p>
	</form>

</body>
</html>
