<?php
$file = fopen("teams.xml", "w+") or die("failed to write file");

$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('failed to connect');

$query = "SELECT * FROM `teams`;";
$result = mysqli_query($connection, $query) or die ("QUERY FAILED");
$filetext = "<xml version='1.0' encoding='UTF-8'>\n";
while ($row = mysqli_fetch_assoc($result)) {
	$name = $row['name'];
	$number = $row['number'];
	$url = "/team.php?id=$number";
	$filetext .= "<link>\n\t<title>$name</title>\n\t<url>$url</url>\n</link>\n";
}
$filetext .= "</xml>\n";
fwrite($file, $filetext);
header("Location: /index.php");
?>
