<?php include('server.php')

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

?>
<!DOCTYPE html>
<html>
<style>
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
	<title>Manager Theather Overview</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Theather Overview</h2>
	</div>



	<form method="post" action="18 manager theather overview.php">
		<div class="input-group">
			<label >Movie Name (Include)</label >
			<input type="text" id="movie_name" name = "movie_name">
		</div>

		<div class="other" >
            <label>Time Duration </label>
            <input name="min_duration" type="number" min="0" value="<?php echo $min_city; ?>">
            <label> -- </label>
            <input name="max_duration" type="number" min="0" value="<?php echo $max_city; ?>">
        </div>

		<div class="other" >
            <label>Movie Release Date</label>
            <input name="min_release_date" type="date" value="<?php echo $min_release_date; ?>">
            <label> -- </label>
            <input name="max_release_date" type="date" value="<?php echo $max_release_date; ?>">
        </div>

		<div class="other" >
            <label>Movie Play Date</label>
            <input name="min_play_date" type="date" value="<?php echo $min_play_date; ?>">
            <label> -- </label>
            <input name="max_play_date" type="date" value="<?php echo $max_play_date; ?>">
        </div>

		<center><input type="checkbox" name="not_played_movies" value="<?php echo $not_played_movies; ?>">Only include not played movies<br></center>

		<div class="input-group">
            <button type="submit" class="btn" name="filter_movies">Filter</button>
		</div>



		<table id="table" table align="center">
		  <tr class="header">
		    <th style="width:20%;"><a>Movie Name</a></th>
            <th style="width:25%;"><a>Duration</a></th>
            <th style="width:15%;"><a>Release Date</a></th>
            <th style="width:20%;"><a>Play Date</a></th>
		  </tr>

          <?php
              if (isset($_POST['filter_movies'])) {
				  // Input: i_manUsername, i_movName, i_minMovDuration, i_maxMovDuration,
				  // i_minMovReleaseDate, i_maxMovReleaseDate, i_minMovPlayDate, i_maxMovPlayDate,
				  // i_includeNotPlayed

                  $username = $_SESSION['username'];
				 //echo $username ;
                  $movie_name = empty($_POST['movie_name']) ? $movie_name = '' :  $movie_name = $_POST['movie_name'];
				 // echo $movie_name;
                  $min_duration = empty($_POST['min_duration'])? 0 : $_POST['min_duration'];
				  //echo $min_duration ;
				  $max_duration = empty($_POST['max_duration']) ? 10000 : $_POST['max_duration'] ;

				  $max_release_date = empty($_POST['max_release_date']) ? '9999-01-01' : $_POST['max_release_date'];
				  $min_release_date = empty($_POST['min_release_date']) ? '0000-01-01' : $_POST['min_release_date'];

				  $max_play_date = empty($_POST['max_play_date']) ? '9999-01-01' : $_POST['max_play_date'];
				  $min_play_date = $_POST['min_play_date'] ? '0000-01-01' : $_POST['min_play_date'];

				  $not_played_movies = isset($_POST['not_played_movies'])? $not_played_movies = TRUE : $not_played_movies = FALSE;
				  //echo $username ." ". $movie_name ." ". $min_duration ." ". $max_duration ." ".  $min_release_date ." ". $max_release_date ." ". $max_play_date ." ". $min_play_date." ". $not_played_movies;

                  $comquery = "call manager_filter_th('$username', '$movie_name', '$min_duration',
				  '$max_duration', '$min_release_date',  '$max_release_date', '$min_play_date', '$max_play_date', '$not_played_movies')";
                  $comsql = mysqli_query($db, $comquery);

                  $comquery = "SELECT * FROM  ManFilterTh";
                  $comsql = mysqli_query($db, $comquery);
                  while ($row = mysqli_fetch_assoc($comsql)) {
                      echo "<tr>" ;
                      echo "
                                <td>".$row["movName"]."</td>
                                <td>".$row["movDuration"]."</td>
                                <td>".$row["movReleaseDate"]."</td>
                                <td>".$row["movPlayDate"]."</td>
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
