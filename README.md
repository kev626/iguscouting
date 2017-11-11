# IguScouting
A scouting sheet developed by Team Iutech (FTC6964).

This scouting sheet was designed as a way to keep track of teams at FTC matches. This was built entirely from scratch, with the assistance of a few very useful Stackoverflow answers (Thanks!).

## Features

* Team surveying page - Ask teams questions about what their robot does, and the sheet saves that data
* Historical data collection - Automatically or manually enter match data. The scouting sheet will calculate historical averages for each team
* Elo calculation - Match data is used to create weighted ELO scores for each team
* Team page - Easily view all teams in the database and all associated data (Plus extra graphs and stats!)
* Individual team page - View even more information about a team by clicking their number or name.
* Match prediction - Predict the likelihood of an alliance winning a match using either surveyed, historical, or elo data.

## Requirements

* Web server
* MySQL Database
* PHP 5.4+ (7 untested)
* (optional) If you want ELO and auto-match scraping (PA, East Super Regional, Worlds tested only), a machine that can run Java (7+) with an internet connection to the scouting sheet and the match pages.

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
5. Contribute to this project! Countless hours have been put in already, and there are plenty of things that could be improved! See below...


## Improvements/TODO

* Create a config file so database statistics, number of teams, etc can be changed from one place
* Add Java-based scrapers/analyzers to the repository
* Document the use of scrapers/analyzers
* Update team survey and scoring for Relic Recovery
* Store team abilities individually instead of in the same string in database
