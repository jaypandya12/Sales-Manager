<?php 
		include 'dbOperation.php';
	?>
product ID: <input type="number" id="productid" value="<?php echo $_GET['id']?>" disabled>
Product name: <input type="text" name="" id="productname">

		Quantity:<br> 
		<input type="number" name="" id="quantity" class="col-md-10">
		<br>
		Manufacturing Date:<br>
		<input type="date" name="" id="mfgdate" class="col-md-10">
		<br>
		Expiration duration in months:<br>
		<input type="text" name="" id="expirytime" class="col-md-10">
		<br>
		Product Price:<br> <input type="number" name="" id="price" class="col-md-10"><br>
		GST:<br> <input type="text" name="" id="gst" class="col-md-10"><br>
		<input type="button" name="" value="Submit" onclick="updateproduct()">
<script type="text/javascript">
	function updateproduct(){
		
		if(document.getElementById('productid').value==""){
			alert("Invalid Product ID");
			return;
		}
		if(document.getElementById('productname').value==""){
			alert("Invalid Product Name");
			return;
		}
		if(document.getElementById('price').value==""){
			alert("Invalid Price");
			return;
		}
		if(document.getElementById('gst').value==""){
			alert("Invalid GST");
			return;
		}
		var strUser = document.getElementById("productname").value;
		$.ajax({
			type: "POST",
			url: "dbOperation.php",
			data: { option: '9',
					productname: strUser,
					productid: $('#productid').val(),
					quantity: $('#quantity').val(),
					mfgdate: $('#mfgdate').val(),
					expirytime: $('#expirytime').val(),
					price: $('#price').val(),
				    gst: $('#gst').val()},
			success: function(insertMessage) {
				alert("Stock Updated Successfully");
			},
			error:function(data){
        	alert("error occured"); //===Show Error Message====
    		}
		});
	}
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
$('.stringvalidation').keydown(function(event) {
	var allow=[8,16,20,32,9,17,46,37,38,39,40];
	if(allow.includes(event.keyCode)){

	}
	else if(event.keyCode<65 || event.keyCode>90){
		event.preventDefault();
	}
});
</script>