<?php 
	$servername="localhost";
	$username="root";
	$password="";
	$dbname="INVOICE";
	$conn=mysqli_connect($servername, $username, $password, $dbname);
	// STATIC $login=false; 
	if($conn){
		//echo "Connected Successfully";
	}
	else{
		die("Connection Failed" . mysqli_connect_error());
	}
?>