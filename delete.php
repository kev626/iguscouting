<link rel="stylesheet" href="css/bootstrap.min.css">
<?php

if (!isset($_GET['sure'])) {
	echo "
	Are you sure you would like to delete team number " . $_GET['number'] . " from the database?<br/>
	<a href='/delete.php?number=" . $_GET['number'] . "&sure=yes'>YES</a><br/>
	<a href='/viewTeams.php'>NO</a>
	";
} elseif ($_GET['sure'] == 'yes') {
	$query = "DELETE FROM `teams` WHERE `teams`.`number` = " . $_GET['number'] . ";";
	mysqli_query($connection, $query);
	header("Location: /viewTeams.php");
}
?>