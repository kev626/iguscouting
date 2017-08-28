<?php

$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');



$getQuery = "SELECT * from `teams` WHERE `teams`.`number` = " . $_GET['number'] . ";";

$result = mysqli_query($connection, $getQuery);

$row = mysqli_fetch_assoc($result);

if ($row['starred'] == 0) {

	$state = 1;

} else {

	$state = 0;

}



$sqlquery = "UPDATE `teams` SET `starred` = '" . $state . "' WHERE `teams`.`number` = " . $_GET['number'] . ";";

mysqli_query($connection, $sqlquery);

$view = $_GET['view'];

header("Location: /viewTeams.php?sort=$view");

?>