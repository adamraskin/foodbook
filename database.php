<?php

$mysql_hostname = "localhost:3306";
$mysql_username = "phpmyadmin";
$mysql_password = "xHlb90DFDpFQZqcMHt4XYp0qJXjnhC";
$mysql_database = "foodbook";
$dsn = "mysql:host=".$mysql_hostname.";dbname=".$mysql_database;
//this file is used in nearly everything to provide database access
$debug = true;
try
{
   $pdo= new PDO($dsn, $mysql_username,$mysql_password, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	echo "dsn set to -> '".$dsn." <-- '";
}
catch (PDOException $e)
{
	echo 'PDO error: could not connect to DB, error: '.$e;
}
