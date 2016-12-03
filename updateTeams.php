<?php

//$teamfile = fopen('teamData.txt', 'a') or die("failed to open file");

$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');
$abilities = "";
$teamscore=0;
$blockScore=0;
$abilities="";
$teamNumber = mysqli_real_escape_string($connection, $_POST['number']);
$teamName = mysqli_real_escape_string($connection, $_POST['teamName']);
if (isset($_POST['autobeacons'])) {
	$teamscore+=$_POST['autobeacons']*30;
}

if (isset($_POST['autoparticlefloor'])) {
	$teamscore+=$_POST['autoparticlefloor']*5;
}

if (isset($_POST['autoparticlegoal'])) {
	$teamscore+=$_POST['autoparticlegoal']*15;
}

if (isset($_POST['teleparticlesgoal'])) {
	$teamscore+=$_POST['teleparticlesgoal']*5;
}

if (isset($_POST['teleparticlesfloor'])) {
	$teamscore+=$_POST['teleparticlesfloor'];
}

if (isset($_POST['telebeacons'])) {
	$teamscore+=$_POST['telebeacons']*10;
}

if (isset($_POST['autopark'])) {
	$teamscore+=$_POST['autopark'];
}

if (isset($_POST['teleball'])) {
	$teamscore+=$_POST['teleball'];
}

if (isset($_POST['autocap'])) {
	if ($_POST['autocap']) {
		$teamscore+=5;
	}
}



/*
fwrite($teamfile, "\r\n<tr><td>" . $_POST['number'] . "</td><td>" . $_POST['teamName'] . "</td><td>" . $teamscore . "</td><td>" . "Autonomous:");

if ($_POST['autorescueBeacon']) {
	fwrite($teamfile, "\t" . "Rescue Beacon");
}
if ($_POST['autoclimber1']) {
	fwrite($teamfile, "\t" . "1 Climber");
}
if ($_POST['autoclimber2']) {
	fwrite($teamfile, "\t" . "2 Climbers");
}
if ($_POST['autofloorgoal']) {
	fwrite($teamfile, "\t" . "Ends on Floor Goal");
}
if ($_POST['automountain0']) {
	fwrite($teamfile, "\t" . "Ends partly on mountain");
}
if ($_POST['automountain1']) {
	fwrite($teamfile, "\t" . "Ends on Low Zone");
}
if ($_POST['automountain2']) {
	fwrite($teamfile, "\t" . "Ends on Mid Zone");
}
if ($_POST['automountain3']) {
	fwrite($teamfile, "\t" . "Ends on High Zone");
}

fwrite($teamfile, "\t" . "Teleop:" . "\t" . "Scores " . $_POST['telescoreamount'] . " debris in ");

if ($_POST['telescore'] == 1) {
	fwrite($teamfile, "Floor Goal");
}
if ($_POST['telescore'] == 5) {
	fwrite($teamfile, "Low Zone");
}
if ($_POST['telescore'] == 10) {
	fwrite($teamfile, "Mid Zone");
}
if ($_POST['telescore'] == 15) {
	fwrite($teamfile, "High Zone");
}

fwrite($teamfile, ", to score " . $blockScore);

fwrite($teamfile, "\t" . "Rescues ");

if ($_POST['ziplines'] == 0) {
	fwrite($teamfile, "0");
}
if ($_POST['ziplines'] == 20) {
	fwrite($teamfile, "1");
}
if ($_POST['ziplines'] == 40) {
	fwrite($teamfile, "2");
}
if ($_POST['ziplines'] == 60) {
	fwrite($teamfile, "3");
}

fwrite($teamfile, " zipliner(s)");

fwrite($teamfile, "\t" . "Parks on ");

if ($_POST['telepark'] == 5) {
	fwrite($teamfile, "floor");
}
if ($_POST['telepark'] == 10) {
	fwrite($teamfile, "low zone");
}
if ($_POST['telepark'] == 20) {
	fwrite($teamfile, "mid zone");
}
if ($_POST['telepark'] == 40) {
	fwrite($teamfile, "high zone");
}
if ($_POST['telepark'] == 80) {
	fwrite($teamfile, "pullup bar");
}

if ($_POST['allClear']) {
	fwrite($teamfile, " and scores all clear signal");
}
fwrite($teamfile, "</td></tr>");
*/
mysqli_query($connection, "
	INSERT INTO `teams` (
`number` ,
`name` ,
`score` ,
`abilities`
)
VALUES (
'$teamNumber', '$teamName', '$teamscore', '$abilities'
);
") or die(mysqli_error($connection));

header('Location: /cron.php');
?>
