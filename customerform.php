<?php 
    session_start();
    include 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		
	</style>
	
	<!-- <link rel="stylesheet" href="indexstyle.css"> -->
	<script type="text/javascript">		
		function getPrice(id){
			var val=document.getElementById(id).value;
			id=id.replace("productsku","price");
			id_number=id.replace("price","");
			
			$.ajax({
			type: "POST",
			url: "dbOperation.php",
			data: { option: '3',
					productsku: val},
			success: function(html) {
				$('#'+id).val(html);
				getGST("productsku"+id_number);
			}
			});
		}
		function getGST(id){
			var val=document.getElementById(id).value;
			id=id.replace("productsku","gst");
			id_number=id.replace("gst","");
			
			$.ajax({
			type: "POST",
			url: "dbOperation.php",
			data: { option: '8',
					productsku: val},
			success: function(html) {
				$('#'+id).val(html);
				showPrice("quantity"+id_number);
			}
			});
		}
		function setName(){
			$.ajax({
			type: "POST",
			url: "dbOperation.php",
			data: { option: '4',
					customermobile: $('#customermobile').val()},
			success: function(html) {
				$('#customername').val(html);
			}
			});
			if(document.getElementById('customername').value!=''){
				document.getElementById('customername').disabled=true;
			}
		}
		function addinvoice(){
			var pname = [];
			var i=0;
			var index=0;
			while(i!=-1){
				var x=document.getElementById('productname'+i);
				
				if(x!=null){
					if(x.value!=0){
						pname[index] = x.options[x.selectedIndex].text;
						index++;
					}
					i++;
				}
				else{
					i=-1;
				}
				
			}
			if(pname[0]==""){
				alert("Please fill all the details");
				return false;
			}
			var quantity = [];
			i=0;
			index=0;
			while(i!=-1){
				var x=document.getElementById('quantity'+i);
				
				if(x!=null){
					if(x.value!=0){
						quantity[index] = x.value;
						index++;
					}
					i++;
				}
				else{
					i=-1;
				}
				
			}
			if(quantity[0]==""){
				alert("Please fill all the details");
				return false;
			}
			var price = [];
			i=0;
			index=0;
			while(i!=-1){
				var x=document.getElementById('price'+i);
				
				if(x!=null){
					if(x.value!=0){
						price[index] = x.value;
						index++;
					}
					i++;
				}
				else{
					i=-1;
				}
				
			}
			if(price[0]==""){
				alert("Please fill all the details");
				return false;
			}
			var gsttotal = [];
			i=0;
			index=0;
			while(i!=-1){
				var x=document.getElementById('gsttotal'+i);
				
				if(x!=null){
					if(x.value!=0){
						gsttotal[index] = x.value;
						index++;
					}
					i++;
				}
				else{
					i=-1;
				}
				
			}
			if(gsttotal[0]==""){
				alert("Please fill all the details");
				return false;
			}
			var productid = [];
			i=0;
			index=0;
			while(i!=-1){
				var x=document.getElementById('productsku'+i);
				
				if(x!=null){
					if(x.value.length!=0){
						productid[index] = x.value;
						index++;
					}
					i++;
				}
				else{
					i=-1;
				}
				
			}
			if(productid[0]==""){
				alert("Please fill all the details");
				return false;
			}
			if(document.getElementById('customermobile').value==""){
				alert("Please fill all the details");
				return false;
			}
			if(productid.length==0){
				alert("Please fill all the details");
				return false;
			}
			var a = document.getElementById("paymentmode");
			var strPay = a.options[a.selectedIndex].text;
			document.getElementById('customermobile').disabled='true';
			$.ajax({
			type: "POST",
			url: "customerinput.php",
			data: { invoiceid: $('#invoiceid').val(),
					customermobile: $('#customermobile').val(),
					customername: $('#customername').val(),
					productname: pname,
					productid: productid,
					quantity: quantity,
					price: price,
					gst: gsttotal,
					paymentmode: strPay
					},
			success: function(insertMessage) {
				
			},
				error:function(data){
				alert("error occured"); 
				}
		});
				$.ajax({
					type: "POST",
					url: "dbOperation.php",
					data: { option: '6',
							productid: productid,
							quantity: quantity,
							},
					success: function(html){
						
					}

			});
			document.getElementById('checkout').disabled=true;
			document.getElementById('checkout').style.display="none";
			document.getElementById('printinvoice').style.display="block";
			document.getElementById('nextinvoice').style.display="block";


	}
	</script>
</head>
<body>
	<div class="container">
	<?php 
		include 'dbOperation.php';
	?>
	Invoice ID: <br>
		<?php
			$tableName="invoice";
			$attributeName="Invoice_ID";
			$condition=" ORDER BY Invoice_ID DESC LIMIT 1";
			$invid=new dbConnect();
			$invoice_array=$invid->getTableData($tableName,$attributeName,$condition);
			foreach ($invoice_array as $row) { ?>
			<input type="number" name="" id="invoiceid" class="col-md-10" value="<?php echo $row['Invoice_ID'] + 1; ?>" disabled>
		<?php }
		?>
	<br>
	Customer Mobile: <br><input type="text" name="" id="customermobile" onchange="setName()" autocomplete minlength="10" class="numericvalidation col-md-10"><br>
	Customer Name: <br><input type="text" name="" id="customername" class="stringvalidation col-md-10"><br>
	<!-- <input type="text" name="" value="" placeholder="" class="col-md-10"> -->
	<div class="container-fluid">
    <table id="myTable" class=" table order-list table-responsive" style="width: 120%">
    <thead>
        <tr>
            <td>Product Name</td>
            <td>Product SKU</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>% GST</td>
            <td>GST</td>
            <td>Total Price</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr id="record0">
            <td>
                <select name="productname" class="productname" id="productname0"  disabled style="width: 220px">
					<option value="0">Select Product</option>
					<?php
					$tableName="Product";
					$attributeName="*";
					$pname=new dbConnect();
					$product_array=$pname->getTableData($tableName,$attributeName);
					
					foreach ($product_array as $row) { ?>
						<option value="<?php echo $row['product_sku']; ?>"><?php echo $row['Product_Name']; ?></option>
					<?php }
					?>
				</select>
            </td>
            <td >
				<input type="text" id="productsku0" class="productsku numericvalidation" onchange="showID(id)" style="width: 120px">
            </td>
            <td >
                <input type="number" name="quantity" id="quantity0" min="0" class="numericvalidation" onchange="showPrice(id)"  >
            </td>
            <td>
                <input type="number" name="price" value="" id="price0" disabled class="numericvalidation" >
            </td>
            <td>
                <input type="number" name="gst" value="" id="gst0" disabled class="numericvalidation" >
            </td>
            <td>
                <input type="number" name="gsttotal" value="" id="gsttotal0" disabled class="numericvalidation" >
            </td>
            <td>
                <input type="number" name="totalprice" value="" id="totalprice0" disabled class="numericvalidation" >
            </td>
            <td><a class="deleteRow"></a>

            </td>
           
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" style="text-align: left;">
                <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
            </td>
        </tr>
        <tr>
        </tr>
    </tfoot>
</table>
</div>

			Payment Mode: <br>
			<select name="" id="paymentmode" class="col-md-10">
				<option value="1">Cash</option>
				<option value="2">UPI</option>
				<option value="3">Debit/Credit Card</option>
			</select>
			<br>
			<input type="button" class="nullvalidation" value="Checkout" id="checkout" onclick="addinvoice()" >
		<input type="button" id="printinvoice" value="Print Invoice" style="display: none;">
	</div>
	<script type="text/javascript">
	$(document).ready(function () {
    var counter = 1;

    $("#addrow").on("click", function () {
        var newRow = $('<tr id=record'+counter+'>');
        var cols = "";

        cols += '<td ><select class="productname" disabled name="productname" id="productname' + counter + '"><option value="0">Select Product</option><?php
				$tableName="Product";
				$attributeName="*";
				$pname=new dbConnect();
				$product_array=$pname->getTableData($tableName,$attributeName);
				
				foreach ($product_array as $row) { ?>
					<option value="<?php echo $row['product_sku']; ?>"><?php echo $row['Product_Name']; ?></option><?php }?>
					</select></td>';
		
		cols += '<td><input type="text" class="numericvalidation" onchange="showID(id)" id="productsku'+ counter + '"></td>';
        cols += '<td><input type="number" class="numericvalidation" min="0" onchange="showPrice(id)" id="quantity' + counter + '"/></td>';
        cols += '<td><input type="number" class="numericvalidation" id="price' + counter + '" disabled/></td>';
        cols += '<td><input type="number" class="numericvalidation" id="gst' + counter + '" disabled/></td>';
        cols += '<td><input type="number" class="numericvalidation" id="gsttotal' + counter + '" disabled/></td>';
        cols += '<td><input type="number" class="numericvalidation" id="totalprice' + counter + '" disabled/></td>';
        

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger " id="deletebtn'+ counter + '"style="col-sm-2" value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
        
    });
    $("table.order-list").on("click", ".ibtnDel", function (event) {
    	//alert(this.id); 
    	var changeid=this.id;
    	changeid = changeid.replace("deletebtn","");
    	changeid = Number(changeid);
    	var temp = changeid;
    	++changeid;
        $(this).closest("tr").remove();
        var i=changeid;
        while(i!=-1){
        	if(document.getElementById('productname'+i)!=null){
	        	document.getElementById('productname'+changeid).id="productname"+temp;
	        	document.getElementById('productsku'+changeid).id="productsku"+temp;
	        	document.getElementById('quantity'+changeid).id="quantity"+temp;
	        	document.getElementById('price'+changeid).id="price"+temp;
	        	document.getElementById('gst'+changeid).id="gst"+temp;
	        	document.getElementById('gsttotal'+changeid).id="gsttotal"+temp;
	        	document.getElementById('totalprice'+changeid).id="totalprice"+temp;
	        	document.getElementById('deletebtn'+changeid).id="deletebtn"+temp;
	        	changeid++;
	        	temp++;
	        	i++;
	        }
	        else{
	        	i=-1;
	        }
        }
        counter -= 1;
    });
});
function showID(id){
		
		var x=$('#'+id).val();
		var i=0;
		id_number=id.replace("productsku","");
		for(i=0;i!=-1 && id_number!=0 && i<id_number;){
			var temp=document.getElementById('productsku'+i);
			if(temp!=null){
			var q = document.getElementById('quantity'+i).value;
			q = Number(q);
				if(temp.value==x){
					//alert("here");
					q+=1;
					document.getElementById('quantity'+i).value=q;
					$('#deletebtn'+id_number).click();
					console.log(id_number);
					if(document.getElementById('productsku'+id_number)==null){
						document.getElementById('addrow').click();
						document.getElementById('productsku'+id_number).focus();	
					}
					showPrice('quantity'+i);
					//alert(document.getElementById('productsku'+id_number));
					if(document.getElementById('productsku'+id_number)==null){
						document.getElementById('addrow').click();
						document.getElementById('productsku'+id_number).focus();	
					}
					return;
				}
				i++;
			}
			else{
				i=-1;
			}
		}
		document.getElementById('productname'+id_number).value=x;

		document.getElementById('quantity'+id_number).value=1;

		getPrice(id);
}
function showPrice(id){
		console.log(id);
		var x=$('#'+id).val();
		id_number=id.replace("quantity","");	
		id=id.replace("quantity","price");
		var y=document.getElementById(id).value;
		console.log(y);
		

		id=id.replace("price","gst");
		var z=document.getElementById(id).value;
		gst=x*y*z*0.01;
		id=id.replace("gst","gsttotal");
		document.getElementById(id).value=gst;
		id=id.replace("gsttotal","totalprice");
		++id_number; 
		document.getElementById(id).value=x*y+gst;
		if(document.getElementById('productsku'+id_number)==null){
		document.getElementById('addrow').click();	
		document.getElementById('productsku'+id_number).focus();
		}	
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
$('#printinvoice').click(function() {
	var invid=document.getElementById('invoiceid').value;
	window.open("printinvoice.php?invoiceid="+invid , '_blank');
});

</script>
<p id="showinvoice">
</p>
<p id="showtotal">
</p>
<input type="button" id="nextinvoice" style="display: none" value="Generate next invoice" onclick="generateinvoice()"></input>
</body>
</html>