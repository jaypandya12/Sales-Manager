<?php 
	include 'dbOperation.php'; 
    session_start();
    include 'session.php';
?>

Product Name:<br>
<select name="productname" class="productname col-md-10" id="productname0">
	<option value="">Select Product</option>
		<?php
		$tableName="Product";
		$attributeName="*";
		$pname=new dbConnect();
		$product_array=$pname->getTableData($tableName,$attributeName);
		// print_r($pname_array);
		foreach ($product_array as $row) { ?>
			<option value="<?php echo $row['product_sku']; ?>"><?php echo $row['Product_Name']; ?></option>
		<?php }
		?>
</select>
<br>
Enter total number of codes:<br>
<input type="number" id="total" min="1" class="numericvalidation col-md-10">
<br>
Enter number of codes per row:<br>
<input type="number" id="per_row" min="1" class="numericvalidation col-md-10">
<br><br>
<input type="button" name="date" value="Generate" id="getbarcode">
<a href="#" target="_blank" style="display: none;" id="showUrl">Click Here</a>
<script type="text/javascript">
$('#getbarcode').click(function() {
	var id = $('#productname0').val();
	var total = $('#total').val();
	var per_row = $('#per_row').val();
	if(total=="" || per_row==""){
		alert("Please fill all the details");
		return false;
	}
	if(id==0){
		alert("Please fill all the details");
		return false;
	}
	var url = "http://localhost:8080/Invoice%20generator/barcode_test.php?id="+id+"&total="+total+"&per_row="+per_row;
	$('#showUrl').attr('href', url);
	// $('#showUrl').css('display', 'block');
	document.getElementById('showUrl').click();
});
$('.numericvalidation').keydown(function(event) {
	var allow=[8,32,9,17,46,37,38,39,40,96,97,98,99,100,101,102,103,104,105];
	if(allow.includes(event.keyCode)){

	}
	else if(event.keyCode<48 || event.keyCode>57){
		event.preventDefault();
	}
	if($(this).val()<0){
		event.preventDefault();
	}
});
</script>