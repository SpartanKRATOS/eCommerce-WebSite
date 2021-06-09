<?php

$dbServername = "localhost"; 
$dbUsername = "root"; 	
$dbPassword = "";		
$dbName = "store";	

$connect=mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// check if the connection did not go well
if(!$connect){
	die("Connection failed: ".mysqli_connect_error());
}