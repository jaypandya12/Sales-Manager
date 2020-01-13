		
		<?php
			$servername="localhost";
			$username="root";
			$password="";
			$dbname="INVOICE";
			$conn=mysqli_connect($servername, $username, $password, $dbname);
			if($conn){
				//echo "Connected Successfully";
			}
			else{
				die("Connection Failed" . mysqli_connect_error());
			}
			$invoiceid=$_POST['invoiceid'];
			$customermobile=$_POST['customermobile'];
			$customername=$_POST['customername'];
			$productname=$_POST['productname'];
			$productid=$_POST['productid'];
			$quantity=$_POST['quantity'];
			$price=$_POST['price'];
			$gst=$_POST['gst'];
			$paymentmode=$_POST['paymentmode'];	
			$totalprice=0;		
			$sqlinvoice = "INSERT INTO invoice (Invoice_ID, Customer_Mobile, Payment_Mode)
			VALUES ('$invoiceid','$customermobile','$paymentmode')";
			if (mysqli_query($conn, $sqlinvoice)) {
			    // echo "true_New record created successfully in Invoice"."<br>";
			} else {
			    // echo "false_Error: " . $sqlinvoice . "<br>" . mysqli_error($conn);
			}
			for($i=0;$i<count($productname);$i++){
				$sqlpurchase = "INSERT INTO purchase (Product_Name, Product_ID, Quantity, Price, GST, Invoice_ID)
				VALUES ('$productname[$i]','$productid[$i]','$quantity[$i]','$price[$i]','$gst[$i]','$invoiceid')";
				if (mysqli_query($conn, $sqlpurchase)) {
				    // echo "true_New record created successfully in purchase"."<br>";
				    $totalprice=$totalprice+$price[$i]+$gst[$i];
				} else {
				    // echo "false_Error: " . $sqlpurchase . "<br>" . mysqli_error($conn);
				}
			}
			$sqlinvoice = "UPDATE invoice SET Billing_Amount='".$totalprice."' 
			WHERE Invoice_ID='".$invoiceid."'";
			if (mysqli_query($conn, $sqlinvoice)) {
			    // echo "true_New record created successfully in Invoice"."<br>";
			} else {
			    // echo "false_Error: " . $sqlinvoice . "<br>" . mysqli_error($conn);
			}
			$sqlcustomer = "INSERT INTO customer (Customer_Mobile, Customer_Name)
			VALUES ('$customermobile','$customername')";
			// echo $result=mysqli_query($conn, $sql);
			if (mysqli_query($conn, $sqlcustomer)) {
			    // echo "true_New record created successfully in customer"."<br>";
			} else {
			    // echo "false_Error: " . $sqlcustomer . "<br>" . mysqli_error($conn);
			}
			echo $totalprice;
		// 	if(document.getElementById('updatestock').value=='1'){
		// 		$.ajax({
		// 			type: "POST",
		// 			url: "dbOperation.php",
		// 			data: { option: '6',
		// 					productid: productid,
		// 					quantity: quantity,
		// 					},
		// 			success: function(html){
		// 				alert("Stock Updated Successfully");
		// 			}

		// 	});
		// }
		?>