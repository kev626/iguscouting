<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

$new = mysqli_real_escape_string($connection, $_POST['comments']);
$number = mysqli_real_escape_string($connection, $_POST['number']);

$query = "UPDATE `teams` SET `comments` = '$new' WHERE `number` = $number";
mysqli_query($connection, $query) or die($mysqli_error($connection));
header("Location: team.php?id=$number");
?>