<?php 
		include 'dbOperation.php';

		$productid=$_GET['id'];
		$sqlupdate = "DELETE FROM Product WHERE Product_ID='".$productid."'";
		if (mysqli_query($conn, $sqlupdate)) {
		    echo "true_New record created successfully in purchase"."<br>";
		} 
		else {
		    echo "false_Error: " . $sqlupdate . "<br>" . mysqli_error($conn);
		}
		header("Location: index.php");

	?>
