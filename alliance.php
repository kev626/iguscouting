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
	<li><a href='/match/view.php'>Matches</a></li>
	<li><a href='/match/'>Sumbit a match</a></li>
	<li class="active"><a href='/alliance.php'>Predict a match</a></li>
</ul>
<link rel="stylesheet" href="css/bootstrap.min.css">
<br/>
<?php

$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

echo "<meta name=viewport content='width=device-width, initial-scale=1, user-scalable=0'/>";
if (!isset($_POST['sent'])) {
	echo "
<form action='/alliance.php' method=POST>
<input type='hidden' name='sent' value='true'/>
<input type='text' name='red1' value='red1' style='color: #FF0000'/><br/>
<input type='text' name='red2' value='red2' style='color: #FF0000'/><br/>
<input type='text' name='blue1' value='blue1' style='color: #0000FF'/><br/>
<input type='text' name='blue2' value='blue2' style='color: #0000FF'/><br/>
<div><input type=radio name='source' value='hypo'/><br/>hypothetical</div><br/><div><input type=radio name='source' value='historical'/><br/>historical</div><br/>
<input type='submit' value='Predict'/>
</form>
	";
} else {
	$red1 = $_POST['red1'];
	$red2 = $_POST['red2'];
	$blue1 = $_POST['blue1'];
	$blue2 = $_POST['blue2'];
	$source=$_POST['source'];
	if ($source == 'hypo') {
		$query = "SELECT * FROM `teams` WHERE `number` = '$red1';";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result) or die("RED1 team not found");
		$red1score = $row['score'];
		$query = "SELECT * FROM `teams` WHERE `number` = '$red2';";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result) or die("RED2 team not found");
		$red2score = $row['score'];
		$query = "SELECT * FROM `teams` WHERE `number` = '$blue1';";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result) or die("BLUE1 team not found");
		$blue1score = $row['score'];
		$query = "SELECT * FROM `teams` WHERE `number` = '$blue2';";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result) or die("BLUE2 team not found");
		$blue2score = $row['score'];
	} else {
		
		$number=$red1;
		$score = 0;
		$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0) { die("Team number $number not found"); }
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['red1'] == $number || $row['red2'] == $number) {
				$score += $row['redscore'];
			} else {
				$score += $row['bluescore'];
			}
		}
		$score = $score/mysqli_num_rows($result);
		$score = $score/2;
		$score = round($score, 0.0);
		$red1score = $score;
		
		$number=$red2;
		$score = 0;
		$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0) { die("Team number $number not found"); }
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['red1'] == $number || $row['red2'] == $number) {
				$score += $row['redscore'];
			} else {
				$score += $row['bluescore'];
			}
		}
		$score = $score/mysqli_num_rows($result);
		$score = $score/2;
		$score = round($score, 0.0);
		$red2score = $score;
		
		$number=$blue1;
		$score = 0;
		$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0) { die("Team number $number not found"); }
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['red1'] == $number || $row['red2'] == $number) {
				$score += $row['redscore'];
			} else {
				$score += $row['bluescore'];
			}
		}
		$score = $score/mysqli_num_rows($result);
		$score = $score/2;
		$score = round($score, 0.0);
		$blue1score = $score;
		
		$number=$blue2;
		$score = 0;
		$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0) { die("Team number $number not found"); }
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['red1'] == $number || $row['red2'] == $number) {
				$score += $row['redscore'];
			} else {
				$score += $row['bluescore'];
			}
		}
		$score = $score/mysqli_num_rows($result);
		$score = $score/2;
		$score = round($score, 0.0);
		$blue2score = $score;
		
	}
	$redscore = $red1score+$red2score;
	$bluescore = $blue1score+$blue2score;
	$difference = abs($redscore-$bluescore);
	echo "
<form action='/alliance.php' method=POST>
<input type='hidden' name='sent' value='true'/>
<input type='text' name='red1' placeholder='$red1' style='color: #FF0000'/>$red1score<br/>
<input type='text' name='red2' placeholder='$red2' style='color: #FF0000'/>$red2score<br/>
<input type='text' name='blue1' placeholder='$blue1' style='color: #0000FF'/>$blue1score<br/>
<input type='text' name='blue2' placeholder='$blue2' style='color: #0000FF'/>$blue2score<br/>
<div><input type=radio name='source' value='hypo'/><br/>hypothetical</div><br/><div><input type=radio name='source' value='historical'/><br/>historical</div><br/>
<input type='submit' value='Predict'/><br/>
</form>
	";
	if ($redscore > $bluescore) {
		echo "<font color='#FF0000'>RED TEAM</font> is predicted to win by <b>$difference</b> points. ($redscore - $bluescore)";
	} else {
		echo "<font color='#0000FF'>BLUE TEAM</font> is predicted to win by <b>$difference</b> points. ($redscore - $bluescore)";
	}
}

function getScore($number) {
	$score = 0;
	$query = "SELECT * FROM `matches` WHERE `red1` = $number OR `red2` = $number OR `blue1` = $number OR `blue2` = $number;";
	$result = mysqli_query($connection, $query);
	echo $result;
	if (mysqli_num_rows($result) == 0) { die("Team number $number not found"); }
	while ($row = mysqli_fetch_assoc($result)) {
		if ($row['red1'] == $number || $row['red2'] == $number) {
			$score += $row['redscore'];
		} else {
			$score += $row['bluescore'];
		}
	}
	$score = $score/mysqli_num_rows($result);
	$score = $score/2;
	$score = round($score, 0.0);
	return $score;
}

?>