<meta name=viewport content="width=device-width initial-scale=1.0"/>
<meta http-equiv="refresh" content="30" />
<link rel="stylesheet" href="../css/bootstrap.min.css">

<style>
ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	background-color: #333;
}
li {
	float: left;
}
li a {
	display: block;
	color: white;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
}
li a:hover {
	background-color: #111;
}
.active {
	background-color: #4CAF50;
}
</style>
<ul>
	<li><a href='/index.php'>Add a team</a></li>
	<li><a href='/viewTeams.php'>Teams</a></li>
	<li class="active"><a href='/match/view.php'>Matches</a></li>
	<li><a href='/match/'>Sumbit a match</a></li>
	<li><a href='/alliance.php'>Predict a match</a></li>
</ul>
<br/><br/>
<?php

$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

$query = "SELECT * FROM `matches` ORDER BY `match` ASC;";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
echo "<table border=1><tr><td><b>Match #</b></td><td><b><center>Red Teams</center></b></td><td><b><center>Blue Teams</center></b></td><td><center><b>Score</b></center></td><td><center><b>Comments</b></center></td></tr>\n";
while ($row = mysqli_fetch_assoc($result)) {
	$match = $row['match'];
	$red1 = $row['red1'];
	$red2 = $row['red2'];
	$blue1 = $row['blue1'];
	$blue2 = $row['blue2'];
	$redscore = $row['redscore'];
	$bluescore = $row['bluescore'];
	$winner = $row['winner'];
	$comments = $row['comments'];
	if ($winner == 'red') {
		echo "<tr bgcolor='FF0000' style='color: #FFFFFF;'>";
	} else if ($winner == 'blue') {
		echo "<tr bgcolor='0000FF' style='color: #FFFFFF;'>";
	} else {
		echo "<tr bgcolor='CCCCCC' style='color: #000000;'>";
	}
	echo "<td><center>$match</center></td><td>$red1<br/>$red2</td><td>$blue1<br/>$blue2</td><td>$redscore-$bluescore</td><td>$comments</td></tr>";
}
echo "</table>";

?>
