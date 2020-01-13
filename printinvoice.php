<?php
include 'sqlconfig.php';
session_start();
include 'session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Invoice Generator</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Datatable CSS AND JS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <style>
    	h1, h3, footer{
			text-align: center;
			margin: auto;
			padding: 20px;
			font-family: sans-serif;
    	}
		@media print {
		  #printpage {
		    display: none;
		  }
		}
    </style>
</head>
<?php

	$id=$_GET['invoiceid'];
	$sqlsel="SELECT * FROM invoice NATURAL JOIN purchase NATURAL JOIN Customer WHERE Invoice_ID='".$id."'";
	$result=mysqli_query($conn,$sqlsel);
	$commondetails=mysqli_fetch_assoc($result);
	$result=mysqli_query($conn,$sqlsel);
	$sqlsum="SELECT SUM(GST) as GST_TOTAL, SUM(Price) as Total_Price from invoice NATURAL JOIN purchase WHERE Invoice_ID='".$id."'";
	$sumresult=mysqli_query($conn,$sqlsum);
	$sumdetails=mysqli_fetch_assoc($sumresult);
?>
<div class="container">
	<h1>Welcome to the Store</h1>
	<h3>Address: </h3>
  <div class="card">
<div class="card-header">
Invoice 
  <span class="float-right"> <strong>Status:</strong> Paid</span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">Customer Detail:</h6>
<div>
<strong></strong>
</div>
<div>Customer Name: <?php echo $commondetails["Customer_Name"]?></div>
<div>Contact no.: <?php echo $commondetails["Customer_Mobile"]?></div>
<div>Sales Executive: <?php echo $_SESSION['userid']?></div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">Invoice Details</h6>
<div>
<div>Date: <?php echo $commondetails["Date_of_Purchase"]?></div>
</div>
<div>Invoice ID: <?php echo $id ?></div>
<div></div>
<div>Payment Mode: <?php echo $commondetails["Payment_Mode"]?> </div>
<!-- <div>Phone: </div> -->
</div>



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Product Name</th>
<th>Product ID</th>

<th class="right">Quantity</th>
  <th class="center">GST</th>
<th class="right">PRICE</th>
</tr>
</thead>
<tbody>
<?php
	$i=1;
	while($row=mysqli_fetch_assoc($result)){
	?>
		<tr>
			<td class="center"><?php echo $i ?></td>
			<td class="left"><?php echo $row["Product_Name"] ?></td>
			<td class="left"><?php echo $row["Product_ID"] ?></td>
			<td class="right"><?php echo $row["Quantity"] ?></td>
			<td class="center"><?php echo $row["GST"] ?></td>
			<td class="right"><?php echo $row["Price"] ?></td>
		</tr>
	<?php
	$i++;
	}
?>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right"><?php echo $sumdetails['Total_Price']; ?></td>
</tr>
<tr>
<td class="left">
 <strong>GST</strong>
</td>
<td class="right"><?php echo $sumdetails['GST_TOTAL']; ?></td>
</tr>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong><?php echo $commondetails['Billing_Amount'] ?></strong>
</td>
</tr>
</tbody>
</table>

</div>

</div>

</div>
<footer style="background-color: rgba(0,0,0,0.03); margin: auto; width: 100%">
	<p style="margin: auto">Thanks for visiting!!!!!</p>
</footer>

</div>
<input type="button" name="" id="printpage" value="Print invoice" onclick="print()" style="margin-left: auto;">
</div>

</html>