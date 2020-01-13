<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="indexstyle.css">
	<script type="text/javascript">
		function insertindb(){
			$.ajax({
			type: "POST",
			url: "dbOperation.php",
			data: { option: '1',
					productname: $('#productname').val(),
					price: $('#price').val(),
					gst: $('#gst').val(),
					updatestock: $('#updatestock').val()},
			success: function(insertMessage) {
				alert("success");
			},
			error:function(data){
        	alert("error occured"); //===Show Error Message====
    		}
		});
			$.fancybox.close();
		}
	</script>
</head>
<body>
	<form>
		<!-- Product Id: <input type="text" name="" id="productid"> -->
		Product name: <input type="text" name="" id="productname">
		Product Price: <input type="number" name="" id="price">
		GST: <input type="text" name="" id="gst">
		Update Stock:
			<select name="" id="updatestock">
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		<input type="button" name="" value="Submit" onclick="insertindb()">
	</form>

</body>
</html>