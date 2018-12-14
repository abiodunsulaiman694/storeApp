<?php
//start session
session_start();
//unset session array
$_SESSION = array();
//$_SESSION = [];

//destroy session
session_destroy();

//redirect
header("Location: login.php");
exit();
?>