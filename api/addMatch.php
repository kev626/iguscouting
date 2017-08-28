<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');
$red1 = $_GET['red1'];
$red2 = $_GET['red2'];
$blue1 = $_GET['blue1'];
$blue2 = $_GET['blue2'];
$redScore = $_GET['redScore'];
$blueScore = $_GET['blueScore'];
$match = $_GET['match'];
$comments = mysqli_real_escape_string($connection, $_GET['comments']);

echo $match;

if ($blueScore > $redScore) {
	$winner = 'blue';
} else if($blueScore < $redScore) {
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
'$match',
'$red1',
'$red2',
'$blue1',
'$blue2',
'$winner',
'$redScore',
'$blueScore',
'$comments'
);
";
mysqli_query($connection, $query) or die(mysqli_error($connection));
echo $match;
$historical = 0;
$raw=mysqli_query($connection, "SELECT * FROM `teams`;");
while ($row = mysqli_fetch_assoc($raw)) {
	$number = $row['number'];
	$historical = 0;
	$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
	$histresult = mysqli_query($connection, $query) or die(mysqli_error($connection));
	if (mysqli_num_rows($histresult) == 0) {
		$historical = 0;
	} else {
		while ($histrow = mysqli_fetch_assoc($histresult)) {
			if ($number == $histrow['red1'] || $number == $histrow['red2']) {
				$historical += $histrow['redscore'];
			} else {
				$historical += $histrow['bluescore'];
			}
		}
		$historical = $historical/mysqli_num_rows($histresult);
		$historical = $historical/2;
		$historical = round($historical, 0.0);
	}
	mysqli_query($connection, "UPDATE `teams` SET `historical` = '$historical' WHERE `teams`.`number` = $number;") or die(mysqli_error($connection));
}
?>
