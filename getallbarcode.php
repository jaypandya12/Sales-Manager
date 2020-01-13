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
// $internal_ggrc_id = $_GET['id'];

// $total = $_GET['total'];
// $per_row = $_GET['per_row'];
$sql="SELECT Product_Name, product_sku FROM Product";
$result=mysqli_query($conn,$sql);

echo "<table>";

while($row=mysqli_fetch_assoc($result)){
	echo '<tr><td><img alt='.$row['product_sku'].' src="http://localhost:8080/Invoice%20generator/barcode.php?text='.$row['product_sku'].'&print=true" /></td></tr>';
}
echo "</table>";
?>