<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

$query = "SELECT * FROM `teams` ORDER BY `number`;";

if (isset($_GET['team'])) {
	$team = mysqli_real_escape_string($connection, $_GET['team']);
	$query = "SELECT * FROM `teams` WHERE `number` = '$team';";
}
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

While ($row = mysqli_fetch_assoc($result)) {
	$teams[] = array(
		'number' => $row['number'],
		'name' => $row['name'],
		'score' => $row['score'],
		'abilities' => $row['abilities'],
		'starred' => $row['starred'],
		'comments' => $row['comments']
	);
}
header('Content-Type: application/json');
echo json_encode($teams, JSON_HEX_QUOT);
?>