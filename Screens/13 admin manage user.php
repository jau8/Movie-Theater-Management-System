<?php include('server.php') ;
    if(isset($_GET['order'])) {
        $order = $_GET['order'] ;
    } else {
        $order = 'username' ;
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
table {
    text-align: center;
}
form {
    align-content: center;
}
</style>
<head>
	<title>Admin Manage User</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Manage User</h2>
	</div>
	<form method="post" action="13 admin manage user.php">
        <?php include('errors.php'); ?>
        <label >Username</label >
		<input type="text" id="manmyInput" name = "manusername">
        <label >Status</label >
        <select type="text" name="statusInput" value="<?php echo $statusInput; ?>">
            <option type = "text" value="All" <?php if (isset($_POST['statusInput']) && $_POST['statusInput'] == 'All') echo 'selected="selected"'; ?>>--ALL--</option>
            <option type = "text" value="Pending" <?php if (isset($_POST['statusInput']) && $_POST['statusInput'] == 'Pending') echo 'selected="selected"'; ?>>Pending</option>
            <option type = "text" value="Declined" <?php if (isset($_POST['statusInput']) && $_POST['statusInput'] == 'Declined') echo 'selected="selected"'; ?>>Declined</option>
            <option type = "text" value="Approved" <?php if (isset($_POST['statusInput']) && $_POST['statusInput'] == 'Approved') echo 'selected="selected"'; ?>>Approved</option>
        </select>

        <div class="input-group">
            <button type="submit" class="btn" name="filter_user">Filter</button>
			<button type="submit" class="btn" name="approve_user" style="float: center;">Approve</button>
            <button type="submit" class="btn" name="decline_user" style="float: center;">Decline</button>
		</div>

		<table id="table" table align="center">
		  <tr class="header">
		    <th style="width:20%;"><a href='?order=username&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>Username</a></th>
            <th style="width:20%;"><a href='?order=status&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>Status</a></th>
            <th style="width:20%;"><a href='?order=creditCardCount&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>Credit Card Count</a></th>
		    <th style="width:20%;"><a href='?order=userType&&sort=<?php echo $asc_or_desc; ?>&&stas=<?php echo $statusInput; ?>'>User Type</a></th>
		  </tr>

          <?php
          // filter users by type
          if (isset($_POST['filter_user'])) { // filter button
              $statusInput = isset($_POST['statusInput'])? $statusInput=$_POST['statusInput']:$statusInput='ALL';
              $_SESSION['thisstatinput'] = $statusInput;
              $manuser = isset($_POST['manusername'])? $manuser=$_POST['manusername']:$manuser='';
              $_SESSION['thismanuser'] = $manuser;

              $comquery = "call admin_filter_user('$manuser', '$statusInput', '', '')";
              $comsql = mysqli_query($db, $comquery);

              $comquery = "SELECT * FROM adfilteruser ORDER BY $order $sort";
              $comsql = mysqli_query($db, $comquery);
              while ($row = mysqli_fetch_assoc($comsql)) {

                  $thisuser = $row["username"] ;
                  echo "<tr>" ;
                  echo "<td><input type='radio' name='radAnswer' id = 'radAnswer' value='" .$row["username"]. "'/>" .$row['username']. "</td>" ;
                  echo "
                            <td>".$row["status"]."</td>
                            <td>".$row["creditCardCount"]."</td>
                            <td>".$row["userType"]."</td>
                        </tr>";
              }
              echo "</table>";
         } else {
             if (!isset($_SESSION['thisstatinput'])) {
                 $statusInput = 'ALL';
             } else {
                 $statusInput = $_SESSION['thisstatinput'] ;
             }
             if (!isset($_SESSION['thismanuser'])) {
                 $manuser = '';
             } else {
                 $manuser = $_SESSION['thismanuser'] ;
             }
             $comquery = "call admin_filter_user('$manuser', '$statusInput', '', '')";
             $comsql = mysqli_query($db, $comquery);

             $comquery = "SELECT * FROM adfilteruser ORDER BY $order $sort";
             $comsql = mysqli_query($db, $comquery);
             while ($row = mysqli_fetch_assoc($comsql)) {

                 $thisuser = $row["username"] ;
                 echo "<tr>" ;
                 echo "<td><input type='radio' name='radAnswer' id = 'radAnswer' value='" .$row["username"]. "'/>" .$row['username']. "</td>" ;
                 echo "
                           <td>".$row["status"]."</td>
                           <td>".$row["creditCardCount"]."</td>
                           <td>".$row["userType"]."</td>
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
