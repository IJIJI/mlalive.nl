<?php

$dbhost = "localhost:3306";
$dbuser = "mlalive__data_acces";
$dbpass = "P5@x5jj7";
$dbname = "mlalive__data";

//$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$dbname = "mlalive";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("Failed to connect to database!");
}
