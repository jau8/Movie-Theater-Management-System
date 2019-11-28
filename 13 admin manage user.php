<?php include('server.php') ;
    if(isset($_GET['order'])) {
        $order = $_GET['order'] ;
    } else {
        $order = 'username' ;
    }
    $sort = isset($_GET['sort']) && strtolower($_GET['sort']) == 'desc' ? 'DESC' : 'ASC';


    $asc_or_desc = $sort == 'ASC' ? 'desc' : 'asc';

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
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function myFunction2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("statusInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<head>
	<title>Admin Manage User</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Manage User</h2>
	</div>
	<form method="post" action="13 admin manage user.php">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for username">
        <label >Status</label >
        <select type="text" name="statusInput" value="<?php echo $statusInput; ?>">
            <option type = "text" value="All">--ALL--</option>
            <option type = "text" value="Pending">Pending</option>
            <option type = "text" value="Declined">Declined</option>
            <option type = "text" value="Approved">Approved</option>
        </select>

        <div class="input-group">
            <button type="submit" class="btn" name="filter_user">Filter</button>
			<button type="submit" class="btn" name="approve_user" style="float: center;">Approve</button>
            <button type="submit" class="btn" name="decline_user" style="float: center;">Decline</button>
		</div>

		<table id="table" table align="center">
		  <tr class="header">
		    <th style="width:20%;"><a href='?order=username&&sort=<?php echo $asc_or_desc; ?>'>Username</a></th>
            <th style="width:20%;"><a href='?order=userType&&sort=<?php echo $asc_or_desc; ?>'>Status</a></th>
            <th style="width:20%;"><a href='?order=creditCardCount&&sort=<?php echo $asc_or_desc; ?>'>Credit Card Count</a></th>
		    <th style="width:20%;"><a href='?order=status&&sort=<?php echo $asc_or_desc; ?>'>User Type</a></th>
		  </tr>

          <?php
          $statusInput = $_POST['statusInput'];
          // filter users by type
          if (isset($_POST['filter_user'])) { // filter button
              $comquery = "call atlanta_movies.admin_filter_user('', '$statusInput', '', '')";
              $comsql = mysqli_query($db, $comquery);

              $comquery = "SELECT * FROM adfilteruser ORDER BY $order $sort";
              $comsql = mysqli_query($db, $comquery);
              while ($row = mysqli_fetch_assoc($comsql)) {

                  $thisuser = $row["username"] ;
                  echo "<tr>" ;
                  echo "<td><input type='radio' name='radAnswer' id = 'radAnswer' value='$thisuser'/>" .$row['username']. "</td>" ;
                  echo "
                            <td>".$row["status"]."</td>
                            <td>".$row["creditCardCount"]."</td>
                            <td>".$row["userType"]."</td>
                        </tr>";
              }
              echo "</table>";
          }
          echo $_POST['radAnswer'];


          ?>

		</table>

        <p>
			<a href="7 admin only functionality.php">Back</a>
		</p>

	</form>

</body>
</html>
