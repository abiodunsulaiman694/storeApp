<?php
define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB', 'storemanagerdb');
//connect to database
//procedural
$conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DB);
//object oriented
//$conn = new mysqli(SERVER, USERNAME, PASSWORD, DB);
//check
if ($conn === false ) {
	die("Error connecting to database - ".mysqli_connect_error());
	//die("Error connecting to database - ".$conn->connect_error());
}








