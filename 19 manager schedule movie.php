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
.date label {
  display: flex;
  align-items: center;
}

.date span::after {
  padding-left: 5px;
}

.date input {
    height: 30px;
	width: 93%;
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
<script>
	var dateControl = document.querySelector('input[type="date"]');
	dateControl.value = '2019-12-01';
	//console.log(dateControl.value);
	//console.log(dateControl.valueAsNumber);

    $(function() {

     /* global setting */
        var datepickersOpt = {
            dateFormat: 'dd-mm-yy',
            minDate   : 0
        }

        $("#releaseDate").datepicker($.extend({
            onSelect: function() {
                var minDate = $(this).datepicker('getDate');
                minDate.setDate(minDate.getDate()); //add two days
                $("#playdate").datepicker( "option", "minDate", minDate);
            }
        },datepickersOpt));

        $("#playdate").datepicker($.extend({
            onSelect: function() {
                var maxDate = $(this).datepicker('getDate');
                maxDate.setDate(maxDate.getDate());
                $("#releaseDate").datepicker( "option", "maxDate", maxDate);
            }
        },datepickersOpt));
    });

</script>
<head>
	<title>Manager Schedule Movie</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Schedule Movie</h2>
	</div>

	<form method="post" action="19 manager schedule movie.php">

		<?php include('errors.php'); ?>

        <?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>

        <div class="input-group">
			<label>Name</label>
			<select class="select-css" type="text" name="movie_name">
				<?php
				$comquery = "SELECT movName FROM movie";
				$comsql = mysqli_query($db, $comquery);
				$colsql = "movName" ;
				while ($row = mysqli_fetch_array($comsql)) {
					$manuser = $row["movName"] ; // value that get passed over to server
					echo "<option value = '$manuser'>$row[$colsql]</option>";
				}
				 ?>
			</select>
		</div>

		<div class="date" >
			<label>Release Date</label>
			<input name="release_date" type="date" value="<?php echo $release_date; ?>">
		</div>

        <div class="date" >
			<label>Play Date</label>

			<input name="play_date" type="date" value="<?php echo $play_date; ?>">
		</div>

        <div class="input-group">
			<button type="submit" class="btn" name="schedule_movie" style="position: relative; ">Schedule</button>
            <button class = 'btn' name = "this-back-button">Back</button>
		</div>
	</form>

</body>
</html>
