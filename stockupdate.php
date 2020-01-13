<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		
	</style>
	<link rel="stylesheet" href="indexstyle.css">
	<script type="text/javascript">
		function setId(){
			var x= document.getElementById('pname_select').value;
			document.getElementById('productid').value=x;
		}
		function updatestock(){
			var e = document.getElementById("pname_select");
			var strUser = e.options[e.selectedIndex].text;
			$.ajax({
			type: "POST",
			url: "dbOperation.php",
			data: { option: '2',
					productname: strUser,
					productid: $('#productid').val(),
					quantity: $('#quantity').val(),
					mfgdate: $('#mfgdate').val(),
					expirytime: $('#expirytime').val()},
			success: function(insertMessage) {
				alert("Stock Updated Successfully");
			},
			error:function(data){
        	alert("error occured"); //===Show Error Message====
    		}
		});
		}
	</script>
</head>
<body>
	
	<?php 
		include 'dbOperation.php';
	?>
	<form>
		Product name: <br>
		<select name="productname"  id="pname_select" onchange="setId()" class="col-md-10">
			<option value="" >Select Product</option>
			<?php
			$tableName="Product";
			$attributeName="*";
			$pname=new dbConnect();
			$product_array=$pname->getTableData($tableName,$attributeName);
			// print_r($pname_array);
			foreach ($product_array as $row) { ?>
				<option value="<?php echo $row['Product_ID']; ?>"><?php echo $row['Product_Name']; ?></option>
			<?php }
			?>
		</select>
		<br>
		Product Id:<br>
		<input type="text" name="" id="productid" value="" class="col-md-10">
		<br>
		Quantity:<br> 
		<input type="number" name="" id="quantity" class="col-md-10">
		<br>
		Manufacturing Date:<br>
		<input type="date" name="" id="mfgdate" class="col-md-10"><br>
		<br>
		Expiration duration in months:<br>
		<input type="text" name="" id="expirytime" class="col-md-10">
		<br>
		<input type="button" name="" value="Submit" onclick="updatestock()">
	</form>
</body>
</html>