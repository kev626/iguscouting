<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');
$red1 = $_POST['red1'];
$red2 = $_POST['red2'];
$blue1 = $_POST['blue1'];
$blue2 = $_POST['blue2'];
$redScore = $_POST['redScore'];
$blueScore = $_POST['blueScore'];
$match = $_POST['match'];
$comments = mysqli_real_escape_string($connection, $_POST['comments']);

if ($blueScore > $redScore) {
	$winner = 'blue';
} else if ($blueScore < $redScore) {
	$winner = 'red';
} else {
	$winner = 'tie';
}
$query = "
INSERT INTO `matches` (
`match`,
`red1`,
`red2`,
`blue1`,
`blue2`,
`winner`,
`redscore`,
`bluescore`,
`comments`
) VALUES (
$match,
$red1,
$red2,
$blue1,
$blue2,
'$winner',
$redScore,
$blueScore,
'$comments'
);
";
mysqli_query($connection, $query) or die(mysqli_error($connection));
header("Location: index.php");
?>