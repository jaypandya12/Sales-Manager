<?php 
		include 'dbOperation.php';

		$categoryid=$_GET['id'];
		$sqlupdate = "DELETE FROM Category WHERE Category_ID='".$categoryid."'";
		if (mysqli_query($conn, $sqlupdate)) {
		    echo "true_New record created successfully in purchase"."<br>";
		} 
		else {
		    echo "false_Error: " . $sqlupdate . "<br>" . mysqli_error($conn);
		}
		header("Location: index.php");

	?>
