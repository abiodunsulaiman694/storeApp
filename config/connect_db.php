<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "storemanagerdb";

//connect to database
$conn = new mysqli($server, $username, $password, $db);

// check
if ($conn->connect_error) {
	die("Error connecting to database - ". $conn->connect_error);
} else {
	//Yay! Successful
}