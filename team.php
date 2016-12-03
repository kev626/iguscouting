<?php
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

$number = mysqli_real_escape_string($connection, $_GET['id']);

?>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<style>
#red {
	background-color: #FF0000;
}

#blue {
	background-color: #0000FF;
	color: #FFFFFF;
}
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
	<li><a href='/match/view.php'>Matches</a></li>
	<li><a href='/match/'>Sumbit a match</a></li>
	<li><a href='/alliance.php'>Predict a match</a></li>
</ul>
<br/>

<?php
	
	$tabledata = "";
	
	
	
	$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
	$histresult = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$historical = 0;
	if (mysqli_num_rows($histresult) == 0) {
		$historical = 0;
	} else {
		
		while ($histrow = mysqli_fetch_assoc($histresult)) {
		
		
			$match = $histrow['match'];
			$red1 = $histrow['red1'];
			$red2 = $histrow['red2'];
			$blue1 = $histrow['blue1'];
			$blue2 = $histrow['blue2'];
			$redscore = $histrow['redscore'];
			$bluescore = $histrow['bluescore'];
			$winner = $histrow['winner'];
			$comments = $histrow['comments'];
			if ($winner == 'red') {
				$tabledata .= "<tr bgcolor='FF0000' style='color: #FFFFFF;'>";
			} else {
				$tabledata .= "<tr bgcolor='0000FF' style='color: #FFFFFF;'>";
			}
			$tabledata .= "<td><center>$match</center></td><td>$red1<br/>$red2</td><td>$blue1<br/>$blue2</td><td>$redscore-$bluescore</td><td>$comments</td></tr>";

		
		
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
	$query = "SELECT * FROM `teams` WHERE `number` = $number;";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$score=$row['score'];
	$name =$row['name'];
	
	echo "<center><h1>Information for team $name ($number)</h1></center>";
	
	echo "<h2>Predicted: $score</h2>";
	echo "<h2>Historical: $historical</h2><br/>";
	
	echo "<table border=1><tr><td><b>Match #</b></td><td><b><center>Red Teams</center></b></td><td><b><center>Blue Teams</center></b></td><td><center><b>Score</b></center></td><td><center><b>Comments</b></center></td></tr>\n";
	echo $tabledata;
	echo "</table>";
	
	//needs to show: matches they were in/ results
	//capabilities!
?>