<?php
if(isset($_SESSION['defDb'])) 
{$defDb = $_SESSION['defDb'];}
else
{ $defDb = 'locumbay';}


//mysql connection information
$hostname = "localhost";  
$database = $defDb; //The name of the database
$username = "root"; //The username for the database
$password = ""; // The password for the database
$travel = mysql_connect($hostname, $username, $password) or die("Could not connect to database");
mysql_select_db($database, $travel) or die("Could not select database");
//?>