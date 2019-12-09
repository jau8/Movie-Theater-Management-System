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
.release_date label {
  display: flex;
  align-items: center;
}

.release_date span::after {
  padding-left: 5px;
}

.release_date input {
    height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}

.release_date input:invalid + span::after {
  content: '✖';
}

.release_date input:valid+span::after {
  content: '✓';
}
</style>
<script>
	var dateControl = document.querySelector('input[type="date"]');
	dateControl.value = '2019-12-01';
	//console.log(dateControl.value); // prints "2017-06-01"
	//console.log(dateControl.valueAsNumber); // prints 1496275200000, a UNIX timestamp
</script>
<head>
	<title>Admin Create Movie</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Create Movie</h2>
	</div>

	<form method="post" action="17 admin create movie.php">

		<?php include('errors.php'); ?>

        <?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>

		<div class="input-group">
			<label>Name </label>
			<input type="text" name="movie_name" value="<?php echo $movie_name; ?>">
			<label>Duration</label>
			<input type="number" name="movie_duration" min="1" value="<?php echo $movie_duration; ?>">
		</div>
		<div class="release_date" >
			<label>Release Date</label>
			<input name="release_date" type="date" value="<?php echo $release_date; ?>">
		</div>

        <div class="input-group">
			<button type="submit" class="btn" name="create_movie" style="position: relative; ">Create</button>
            <button class = 'btn' name = "this-back-button">Back</button>
		</div>
	</form>

</body>
</html>
