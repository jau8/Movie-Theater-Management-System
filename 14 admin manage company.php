<?php include('server.php') ?>
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
		<div class="input-group">
			<label>Company Name</label>
			<select class="select-css" type="text" name="company">
				<?php
				$comquery = "SELECT * FROM company";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "Name" ;
				while ($row = mysqli_fetch_array($comsql)) {
					echo "<option>$row[$colsql]</option>";
				}
				 ?>
	  		</select>
		</div>
		<p>
			<a href="7 admin only functionality.php">Back</a>
		</p>
	</form>
</body>
</html>
