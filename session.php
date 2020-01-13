<?php 
include 'sqlconfig.php';

$user=$_SESSION['userid'];
$sessionsql="SELECT ID FROM LOGIN WHERE ID='".$user."'";
$result=mysqli_query($conn, $sessionsql);
$row=mysqli_fetch_assoc($result);

if(!isset($row['ID'])){
	header("Location: login.php");
}

?>