<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');
$team = $_GET['team'];
$elo = $_GET['elo'];

$query = "UPDATE `teams` SET `elo` = '$elo' WHERE `teams`.`number` = $team;";
mysqli_query($connection, $query) or die(mysqli_error($connection));
?>
