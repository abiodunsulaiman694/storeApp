<?php
define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB', 'storemanagerdb');
//connect to database
$conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DB);
//check
if ($conn === false ) {
	die("Error connecting to database - ".mysqli_connect_error());
}