<?php

?>
<head>
<meta name=viewport content="width=device-width, initial-scale=1, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="white">
<link rel="stylesheet" href="css/bootstrap.min.css">

<style>
#submit {
width: 100%;
height: 2em;
font-size: 1.5em;
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
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div id='font'>
<ul>
	<li class="active"><a href='/index.php'>Add a team</a></li>
	<li><a href='/viewTeams.php'>Teams</a></li>
	<li><a href='/match/view.php'>Matches</a></li>
	<li><a href='/match/'>Sumbit a match</a></li>
	<li><a href='/alliance.php'>Predict a match</a></li>
</ul>
<form action='updateTeams.php' method=POST>
<h1>Igutech Scouting Sheet</h1>

Team Number: <input type=text name='number'/><br/>
Team Name:   <input type=text name='teamName'/><br/>
<h3>Autonomous</h3>
Amount of beacons: <input type='text' name='autobeacons'/><br/>
Particles in floor: <input type='text' name='autoparticlefloor'/><br/>
Particles in goal: <input type='text' name='autoparticlegoal'/><br/><br/>

Parked normally: <input type='radio' name='autopark' value="0"/><br/>
Parked partially on center: <input type='radio' name='autopark' value="5"/><br/>
Parked fully on center: <input type='radio' name='autopark' value="10"/><br/>
Partially on corner vortex<input type='radio' name='autopark' value="5"/><br/>
Fully on corner vortex: <input type='radio' name='autopark' value="10"/><br/><br/>

Cap ball in contact with floor: <input type='checkbox' name='autocap'/><br/>

<h3>Teleop Scoring</h3>

Particles in goal: <input type='text' name='teleparticlesgoal'/><br/>
Particles in floor: <input type='text' name='teleparticlesfloor'/><br/><br/>

Beacons controlled at end: <input type='text' name='telebeacons'/><br/><br/>

Ball normally: <input type='radio' name='teleball' value='0'/><br/>
Ball slightly off floor: <input type='radio' name='teleball' value='10'/><br/>
Ball above 30&quot; <input type='radio' name='teleball' value='20'/><br/>
Ball Capped: <input type='radio' name='teleball' value='40'/><br/><br/><br/>

<center><input type='submit' id='submit' value='Submit'/></center>
</form>
</div>
</body>