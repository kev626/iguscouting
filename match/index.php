<meta name=viewport content="width=device-width initial-scale=1.0"/>
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
	<li class="active"><a href='/match/'>Sumbit a match</a></li>
	<li><a href='/alliance.php'>Predict a match</a></li>
</ul>
<br/>

<form action='create.php' METHOD=POST>
<input type=text name='match' placeholder='match #'/><br/>
<input type=text name='red1' id='red'/><br/>
<input type=text name='red2' id='red'/><br/>
<input type=text name='blue1' id='blue'/><br/>
<input type=text name='blue2' id='blue'/><br/>
<input type=text name='redScore' placeholder='red score'/><br/>
<input type=text name='blueScore' placeholder='blue score'/><br/>
<input type=text name='comments' placeholder='Comments...'/><br/>
<input type=submit value='Submit'/>
</form>