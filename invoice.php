
<?php
include 'sqlconfig.php';

if(isset($_POST['counter']) && isset($_POST['invoiceid'])){
	$id=$_POST['invoiceid'];
	$getamount="SELECT Billing_Amount FROM invoice WHERE Invoice_ID='".$id."'";
	$result=mysqli_query($conn, $getamount);
	$row=mysqli_fetch_assoc($result);
	$amount=$row['Billing_Amount'];
	echo $amount;
	}
else if(isset($_POST['invoiceid'])){
$id=$_POST['invoiceid'];
$sqlsel="SELECT * FROM invoice NATURAL JOIN purchase WHERE Invoice_ID='".$id."'";
$result=mysqli_query($conn,$sqlsel);
$commondetails=mysqli_fetch_assoc($result);
$result=mysqli_query($conn,$sqlsel);
if(mysqli_num_rows($result)>0){
	?>
	<div class="container">
	<table border="1" class="table outputtable">
		<thead>
			Date Of Purchase : <?php echo $commondetails["Date_of_Purchase"] ?><br>
			Customer Mobile : <?php echo $commondetails["Customer_Mobile"] ?><br>
			Payment Mode : <?php echo $commondetails["Payment_Mode"] ?><br>
			<tr>
			<th > Product Name </th>
			<th > Product ID</th>
			<th > Quantity</th>
			<th > GST</th>
			<th > Price</th>
			</tr>
		</thead>
		<tbody>
	<?php
	while($row=mysqli_fetch_assoc($result)){
	?>
		<tr>
			<td><?php echo $row["Product_Name"] ?></td>
			<td><?php echo $row["Product_ID"] ?></td>
			<td><?php echo $row["Quantity"] ?></td>
			<td><?php echo $row["GST"] ?></td>
			<td><?php echo $row["Price"] ?></td>
		</tr>
		<!-- echo "Name: ".$row["Name"]." ID: ".$row["ID"]." Date of Birth: ".$row["DOB"]." City: ".$row["City"]." Email: ".$row["Email"]." Password: ".$row["Password"]."<br>" -->
	<?php
	}
	?>
	</tbody>
	</table>
</div>
<?php
}
else{
	echo "Invalid ID entered";
	}
}else if(isset($_POST['counter']) && isset($_POST['date'])){
	$date=$_POST['date'];
	$getamount="SELECT SUM(Billing_Amount) AS Amount FROM invoice WHERE CAST(Date_of_Purchase AS DATE)='".$date."'";
	$result=mysqli_query($conn, $getamount);
	$row=mysqli_fetch_assoc($result);
	$amount=$row['Amount'];
	echo $amount;
	}
	else if(isset($_POST['counter']) && isset($_POST['date1'])){
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	$getamount="SELECT SUM(Billing_Amount) AS Amount FROM invoice WHERE CAST(Date_of_Purchase AS DATE)>='".$date1."' AND 
	CAST(Date_of_Purchase AS DATE)<='".$date2."'";
	$result=mysqli_query($conn, $getamount);
	$row=mysqli_fetch_assoc($result);
	$amount=$row['Amount'];
	echo $amount;
	}

elseif (isset($_POST['date'])) {
	$date=$_POST['date'];
	$sqlsel="SELECT * FROM invoice NATURAL JOIN purchase WHERE CAST(Date_of_Purchase AS DATE)='".$date."'";
	$result=mysqli_query($conn,$sqlsel);

	if(mysqli_num_rows($result)>0){
		?>
		<div class="container">
		<table border="1" class="table outputtable">
			<thead>
			<tr>
				<th > Invoice ID </th>
				<th > Customer Mobile </th>
				<th > Product Name </th>
				<th > Product_ID</th>
				<th > Quantity</th>
				<th > Price</th>
				<th > Payment Mode</th>
			</tr>
			</thead>
			<tbody>
		<?php
		while($row=mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td><?php echo $row["Invoice_ID"] ?></td>
				<td><?php echo $row["Customer_Mobile"] ?></td>
				<td><?php echo $row["Product_Name"] ?></td>
				<td><?php echo $row["Product_ID"] ?></td>
				<td><?php echo $row["Quantity"] ?></td>
				<td><?php echo $row["Price"] ?></td>
				<td><?php echo $row["Payment_Mode"] ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
		</table>
	</div>
	<?php
	}
	else{
		echo "Invalid Date entered";
		}
}
elseif (isset($_POST['date1'])) {
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	$sqlsel="SELECT * FROM invoice NATURAL JOIN purchase WHERE CAST(Date_of_Purchase AS DATE)>='".$date1."' AND 
	CAST(Date_of_Purchase AS DATE)<='".$date2."'";
	$result=mysqli_query($conn,$sqlsel);

	if(mysqli_num_rows($result)>0){
		?>
		<div class="container">
		<table border="1" class="table outputtable">
			<thead>
			<tr>
				<th > Invoice ID </th>
				<th > Customer Mobile </th>
				<th > Product Name </th>
				<th > Product_ID</th>
				<th > Quantity</th>
				<th > Price</th>
				<th > Payment Mode</th>
			</tr>
			</thead>
			<tbody>
		<?php
		while($row=mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td><?php echo $row["Invoice_ID"] ?></td>
				<td><?php echo $row["Customer_Mobile"] ?></td>
				<td><?php echo $row["Product_Name"] ?></td>
				<td><?php echo $row["Product_ID"] ?></td>
				<td><?php echo $row["Quantity"] ?></td>
				<td><?php echo $row["Price"] ?></td>
				<td><?php echo $row["Payment_Mode"] ?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
		</table>
	</div>
	<?php
	}
	else{
		echo "Invalid Date entered";
		}
	}
	if(isset($_POST['counter'])){
		$counter=$_POST['counter'];
		if($counter=="customerdetail"){
			$sqlsel="SELECT * FROM customer";
			$result=mysqli_query($conn,$sqlsel);

			if(mysqli_num_rows($result)>0){
				?>
				<div class="container">
				<table border="1" class="table outputtable">
					<thead>
					<tr>
						<th > Customer Mobile </th>
						<th > Customer Name </th>
					</tr>
					</thead>
					<tbody>
				<?php
				while($row=mysqli_fetch_assoc($result)){
				?>
					<tr>
						<td><?php echo $row["Customer_Mobile"] ?></td>
						<td><?php echo $row["Customer_Name"] ?></td>
					</tr>
				<?php
				}
				?>
			</tbody>
				</table>
			</div>
			<?php
			}
		}
		if($counter=="categorydetail"){
			$sqlsel="SELECT * FROM category";
			$result=mysqli_query($conn,$sqlsel);
			$catarray=[];
			while($row=mysqli_fetch_assoc($result)){
					$catarray[$row['Category_ID']] = $row['Category_Name'];
				}
			$result=mysqli_query($conn,$sqlsel);
			if(mysqli_num_rows($result)>0){
				?>
				<div class="container">
				<table border="1" class="table outputtable" id="categorytable">
					<thead>
					<tr>
						<th > Category ID </th>
						<th > Category Name </th>
						<th > Parent Category </th>
						<th ></th>
						<th ></th>
					</tr>
					</thead>
					<tbody>
				<?php
				while($row=mysqli_fetch_assoc($result)){
					$catarray[$row['Category_ID']] = $row['Category_Name'];
				?>
					<tr>
						<td class="cat_id"><?php echo $row["Category_ID"] ?></td>
						<td class="cat_name"><?php echo $row["Category_Name"] ?></td>
						<td class="cat_parent"><?php echo $catarray[$row["Parent_Category"]] ?></td>
						<td><a href="updatecategory.php?id=<?php echo $row["Category_ID"] ?>" class="various fancybox.ajax">
							<input type="button" value="Edit"></a></td>
						<td><a href="deletecategory.php?id=<?php echo $row["Category_ID"] ?>" class="various fancybox.ajax">
							<input type="button" value="Delete" class="deletecategory"></a></td>
					</tr>
					
				<?php
				}
				?>
				</tbody>
				</table>
			</div>
			<?php
			}
			?>
			<a href="addcategory.php" class="various fancybox.ajax"><input type="button" value="Add Category"></a>
			<?php
		}
		if($counter=="productdetail"){
			$sqlsel="SELECT * FROM product NATURAL JOIN stock";
			$result=mysqli_query($conn,$sqlsel);

			if(mysqli_num_rows($result)>0){
				?>
				<div class="container">
				<table border="1" class="table outputtable">
					<thead>
					<tr>
						<th > Product_ID</th>
						<th > Product Name </th>
						<th > Product SKU</th>
						<th > Quantity</th>
						<th > Price</th>
						<th > GST </th>
						<th > Manufacturing Date </th>
						<th > Expiry time</th>
						<th > Category ID</th>
						<th > Update Value</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>	
				<?php
				while($row=mysqli_fetch_assoc($result)){
				?>
					<tr>
						<td><?php echo $row["Product_ID"] ?></td>
						<td><?php echo $row["Product_Name"] ?></td>
						<td><a target="_blank" href="barcode_test.php?id=<?php echo $row["product_sku"] ?>&total=20&per_row=3"><?php echo $row["product_sku"] ?></a></td>
						<td><?php echo $row["Quantity"] ?></td>
						<td><?php echo $row["Price"] ?></td>
						<td><?php echo $row["GST"] ?></td>
						<td><?php echo $row["Manufacturing_date"] ?></td>
						<td><?php echo $row["Expiry_time"] ?></td>
						<td><?php echo $row["Category_ID"] ?></td>
						<td><?php echo $row["Update_Value"] ?></td>
						<td><a href="updateproduct.php?id=<?php echo $row["Product_ID"] ?>" class="various fancybox.ajax">
							<input type="button" value="Edit"></a></td>
						<td><a href="deleteproduct.php?id=<?php echo $row["Product_ID"] ?>" class="various fancybox.ajax">
							<input type="button" value="Delete" class="deleteproduct"></a></td>
					</tr>
					
				<?php
				}
				?>
			</tbody>
				</table>
			</div>
			<?php
			}
			?>
			<a href="addproduct.php" class=" listitem various fancybox.ajax" ><input type="button" value="Add Product"></a>
			<?php
		}
	}

$conn->close();

?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".various").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: true,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
	$(document).ready(function() {
    $('.outputtable').DataTable( {
        dom: 'Bfrtip',
        'destroy': true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
	$('.deletecategory').click(function(event){
		$(this).closest('tr').remove();
	});
	$('.deleteproduct').click(function(event){
		$(this).closest('tr').remove();
	});
	
	
</script>