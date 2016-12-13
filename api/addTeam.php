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
	$abilities.="{$_POST['autobeacons']} beacon(s), ";
}

if (isset($_POST['autoparticlefloor'])) {
	$teamscore+=$_POST['autoparticlefloor']*5;
	$abilities.="{$_POST['autoparticlefloor']} particles in floor goal, ";
}

if (isset($_POST['autoparticlegoal'])) {
	$teamscore+=$_POST['autoparticlegoal']*15;
	$abilities.="{$_POST['autoparticlegoal']} particles in center vortex, ";
}
if (isset($_POST['autocap'])) {
	if ($_POST['autocap'] == 5) {
		$teamscore+=5;
		$abilities.="Cap ball touches the floor, ";
	}
}
if (isset($_POST['autopark'])) {
	$teamscore+=$_POST['autopark'];
	$abilities.="and parks for {$_POST['autopark']} points. ";
}

$abilities.="TELEOP: ";

if (isset($_POST['teleparticlesgoal'])) {
	$teamscore+=$_POST['teleparticlesgoal']*5;
	$abilities.="{$_POST['teleparticlesgoal']} particles in center vortex, ";
}

if (isset($_POST['teleparticlesfloor'])) {
	$teamscore+=$_POST['teleparticlesfloor'];
	$abilities.="{$_POST['teleparticlesfloor']} particles in floor goal, ";
}

if (isset($_POST['telebeacons'])) {
	$teamscore+=$_POST['telebeacons']*10;
	$abilities.="{$_POST['telebeacons']} beacons controlled in endgame, ";
}

if (isset($_POST['teleball'])) {
	$teamscore+=$_POST['teleball'];
	$abilities.="and scores {$_POST['teleball']} points with the cap ball (in endgame).";
}

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

include "../cron.php";
?>
