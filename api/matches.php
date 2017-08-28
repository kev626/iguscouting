<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

$query = "SELECT * FROM `matches`;";

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

While ($row = mysqli_fetch_assoc($result)) {
	$matches[] = array(
		'match' => $row['match'],
		'red1' => $row['red1'],
		'red2' => $row['red2'],
		'blue1' => $row['blue1'],
		'blue2' => $row['blue2'],
		'redscore' => $row['redscore'],
		'bluescore' => $row['bluescore'],
		'winner' => $row['winner'],
		'comments' => $row['comments']
	);
}
header('Content-Type: application/json');
echo json_encode($matches, JSON_HEX_QUOT);
?>