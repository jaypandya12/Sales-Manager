<?php 
		include 'dbOperation.php';
	?>
Category ID: <input type="number" id="categoryid" value="<?php echo $_GET['id']?>" disabled>
Category Name: <input type="text" value="" placeholder="" id="categoryname"  class="stringvalidation">
Parent Category: 
<select  id="parentcategory" >
					<option value="">Select Parent Category</option>
					<?php
					$tableName="Category";
					$attributeName="*";
					$pname=new dbConnect();
					$category_array=$pname->getTableData($tableName,$attributeName);
					// print_r($pname_array);
					foreach ($category_array as $row) { ?>
						<option value="<?php echo $row['Category_ID']?>" class="numericvalidation"><?php echo $row['Category_Name']; ?></option>
					<?php }
					?>
					<input type="button" name="" value="Submit" id="updatecategorybutton" onclick="updatecategory()">
</select>
<script type="text/javascript">
	function updatecategory(){
		
		if(document.getElementById('categoryid').value==""){
			alert("Invalid Category ID");
			return;
		}
		if(document.getElementById('categoryname').value==""){
			alert("Invalid Category Name");
			return;
		}
		$.ajax({
			url: 'dbOperation.php',
			type: 'POST',
			data: { option: '7',
					categoryid: $('#categoryid').val(),
					categoryname: $('#categoryname').val(),
					parentcategory: $('#parentcategory').val()
					},
			success: function(message){
				// alert("Success");
				$.fancybox.close();
				categorydetail();
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