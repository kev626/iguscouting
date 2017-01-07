<?php
$totalTeams = 33;
$recordedTeams = 0;
$totalScore = 0;
?>

<!DOCTYPE html>
<head>
<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","search.php?q="+str,true);
  xmlhttp.send();
}
</script>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
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
td {
    vertical-align: middle !important;
}
</style>

<ul>
	<li><a href='/index.php'>Add a team</a></li>
	<li class="active"><a href='/viewTeams.php'>Teams</a></li>
	<li><a href='/match/view.php'>Matches</a></li>
	<li><a href='/match/'>Sumbit a match</a></li>
	<li><a href='/alliance.php'>Predict a match</a></li>
</ul>
<br/><br/>
<div style="width: 100%;">
   <div style="float:left; width: 40%">
	Click a link to sort by that category<br/>
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<td><b><a href='/viewTeams.php?sort=number'>Team Number</a></b><br/>
<form action='team.php' method='GET'>
<input type='text' name='id'/>
</form>
</td>
<td><b><a href='/viewTeams.php?sort=name'>Team Name</a></b><br/>
<form>
<input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch" width='200'></div>
</form>
</td>
<td><b><a href='/viewTeams.php?sort=score'>Score</a></b></td>
<td><b><a href='/viewTeams.php?sort=historical'>Historical</a></b></td>
<td><center><b><a href='/viewTeams.php?sort=star'>S</a></b></center></td>
<td></td>
</tr>
</thead>
<tbody>
<?php

$histogramText = "";

$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');
$query = "SELECT * FROM teams ";
if (isset($_GET['sort'])) {
	if ($_GET['sort'] == 'number') {
		$query = $query . "ORDER BY number ASC";
	} elseif ($_GET['sort'] == 'name') {
		$query = $query . "ORDER BY name ASC";
	} elseif ($_GET['sort'] == 'score') {
		$query = $query . "ORDER BY score DESC";
	} elseif ($_GET['sort'] == 'star') {
		$query = $query . "ORDER BY starred DESC";
	} elseif ($_GET['sort'] == 'historical') {
		
	}

	$view = $_GET['sort'];
}
$query = $query . ";";


$raw = mysqli_query($connection, $query) or die(mysqli_error($connection));
if (mysqli_num_rows($raw) > 0) {
	//output data of each row
	while($row = mysqli_fetch_assoc($raw)) {
		$name = str_replace("\\", "", $row['name']); //remove the backslash character from any team names
		if (!isset($_GET['number']) || $_GET['number'] == $row['number']) {
			$historical = 0;
			$number = $row['number'];
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
			if ($row['starred'] == 0) {	
				echo "<tr><td><a href='team.php?id=" . $row['number'] . "'>" . $row['number'] . "</td><td>" . $name . "</td><td>" . $row['score'] . "</td><td>$historical</td><td><a href='/star.php?number=" . $row['number'] . "'><img src='star.png'/></a></td><td><a href='/delete.php?number=" . $row['number'] . "'><img src='/delete.png'/></a></td></tr>\n";
			} else {
				echo "<tr class='danger'><td><a href='team.php?id=" . $row['number'] . "'>" . $row['number'] . "</td><td>" . $name . "</td><td>" . $row['score'] . "</td><td>$historical</td><td><a href='/star.php?number=" . $row['number'] . "&view='><img src='unstar.png'/></a></td><td><a href='/delete.php?number=" . $row['number'] . "'><img src='/delete.png'/></a></td></tr>\n";
			}
		}
		$recordedTeams++;
		$totalScore+=$row['score'];
		
		$number=$row['number'];
		$score=$row['score'];
		$name = str_replace("'", "", $row['name']); //remove the quote character from any team names
		$name = str_replace("\\", "", $name); //remove the backslash character from any team names
		$histogramText = $histogramText . "['$number: $name', $score],\n";
			
	}
} else {
	echo "No results found in database";
}

//Calculate Statistics for display
$largestSQL = mysqli_query($connection, "SELECT MAX(score) AS max FROM `teams`;") or die (mysqli_error($connection));
$row = mysqli_fetch_assoc($largestSQL);
$largestScore = $row['max'];

$smallestSQL = mysqli_query($connection, "SELECT MIN(score) AS min FROM `teams`;") or die (mysqli_error($connection));
$row = mysqli_fetch_assoc($smallestSQL);
$smallestScore = $row['min'];

$averageScore = $totalScore/$recordedTeams;
?>
</tbody>
</table>
   </div>
   <div style="float:right; width: 40%">
		<center>
			<h1>Graphs &amp; Stats</h1>
			<h3>Total Teams: <?php echo $totalTeams; ?></h3>
			<h3>Surveyed Teams: <?php echo $recordedTeams; ?></h3>
			<div class="progress" style="width:50%">
				<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo round($recordedTeams/$totalTeams*100, 0.0); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($recordedTeams/$totalTeams*100, 0.0) . "%"; ?>">
					
				<span class="progress-completed"><?php echo round($recordedTeams/$totalTeams*100, 0.0) . "%"; ?> completed</span>
				</div>
			</div>
			<h3>Highest Score: <?php echo $largestScore; ?></h3>
			<h3>Lowest Score: <?php echo $smallestScore; ?></h3>
			<h3>Average Score: <?php echo round($averageScore, 0.0); ?></h3>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				google.charts.load("current", {packages:["corechart"]});
				google.charts.setOnLoadCallback(drawChart);
				function drawChart() {
					var data = google.visualization.arrayToDataTable([
					['Team', 'Score'],
					<?php echo $histogramText; ?>
					]);

					var options = {
						title: 'Scores of teams',
						legend: { position: 'none' },
					};

					var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
					chart.draw(data, options);
				}
				</script>

			<div id="chart_div" style="width: 100%; height: 500px;"></div>
		</center>
   </div>
</div>
<div style="clear:both"></div>
