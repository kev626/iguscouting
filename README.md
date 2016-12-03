# iguscouting
A scouting sheet developed by team igutech (FTC6964).

This scouting sheet was designed as a way to keep track of teams at FTC matches. This scouting sheet can caluclate predicted values for teams at matches.

## Requirements

* Web server
* Mysql Database
* PHP 5.4+

## Setup

1. Upload the file 'database.sql' to a new database on your mysql server.
2. Upload all files in the project to your web root. (except the .sql)
3. In all .php files, replace the following lines with your database info. Don't worry, some files (ex: index.php) do not have this code. You can safely ignore this.

```PHP
$dbhost = "localhost";	
$db = "igutech";
$dbuser = "root";
$dbpass = "";
```

4. Start using the site! there may be errors present, but they will disappear when teams and matches are added to the system.
5. Contribute to this project! Countless hours have been put in already, and there are plenty of things that could be improved!
