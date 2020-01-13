<?php
include 'sqlconfig.php';
	class dbConnect{

		public function getTableData($tableName,$attributeName,$condition="") {
			global $conn;
			$sql = "SELECT ".$attributeName." FROM ".$tableName.$condition;
			$result=mysqli_query($conn,$sql);
			$i=0;
			$var=array();
			if(mysqli_num_rows($result)>0){
			    while($row=mysqli_fetch_assoc($result)){
			    	$var[$i]=$row;
			    	$i=$i+1;//$i++;
			    }
			    return $var;
			} else {
			    echo "false_Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

	}

if(isset($option)){
$option=$_POST['option'];
switch ($option){
	case '1':
		{
			$price=$_POST['price'];	
			$productname=$_POST['productname'];
			$updatestock=$_POST['updatestock'];
			// $mfgdate=$_POST['mfgdate'];
			// $expirytime=$_POST['expirytime'];
			$gst=$_POST['gst'];
			echo $sql = "INSERT INTO Product (Product_Name, Price, GST, Update_Value)
			VALUES ('$productname','$price','$gst','$updatestock')";
			// echo $result=mysqli_query($conn, $sql);
			if (mysqli_query($conn, $sql)) {
			    echo "true_New record created successfully"."<br>";
			} else {
			    echo "false_Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			echo $getId="SELECT Product_ID from Product WHERE Product_Name='".$productname."'";
			$result=mysqli_query($conn, $getId);
			$row=mysqli_fetch_assoc($result);
			$id=$row['Product_ID'];
			$sql = "INSERT INTO Stock (Product_Name, Product_ID, Price, Update_Value)
			VALUES ('$productname','$id','$price','$updatestock')";
			// echo $result=mysqli_query($conn, $sql);
			if (mysqli_query($conn, $sql)) {
			    echo "true_New record created successfully"."<br>";
			} else {
			    echo "false_Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		
		break;
		}
		case '2':
			{
			$productid=$_POST['productid'];	
			$productname=$_POST['productname'];	
			$quantity=$_POST['quantity'];
			$mfgdate=$_POST['mfgdate'];
			if($mfgdate==""){
				$mfgdate="now()";
			}
			$expirytime=$_POST['expirytime'];
			if($expirytime==""){
				$expirytime=0;
			}
			echo $sql = "UPDATE Stock SET Quantity=Quantity+".$quantity.
					", Manufacturing_date = ".$mfgdate.
					", Expiry_time = ".$expirytime.
					" WHERE Product_ID = ".$productid;
			if (mysqli_query($conn, $sql)) {
			    echo "true_New record created successfully"."<br>";
			} else {
			    echo "false_Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		
			break;
		}
		case '3':
			{
				$productsku=$_POST['productsku'];
				$sql = "SELECT Price FROM Product WHERE product_sku=".$productsku;
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
				    $row=mysqli_fetch_assoc($result);
				    $price=$row['Price'];
				    echo $price;
				} else {
				    echo "false_Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			break;
		}
		case '4':
			{
				$customermobile=$_POST['customermobile'];
				$sql = "SELECT Customer_Name FROM customer WHERE Customer_Mobile=".$customermobile;
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
				    $row=mysqli_fetch_assoc($result);
				    $mobile=$row['Customer_Name'];
				    echo $mobile;
				} else {
				    echo "";
				}
			
			break;
			}	
		case '5':
			{
				$categoryid=$_POST['categoryid'];
				$categoryname=$_POST['categoryname'];
				$parentcategory=$_POST['parentcategory'];
				$sql="INSERT INTO Category (Category_ID, Category_Name, Parent_Category)
				VALUES ('$categoryid','$categoryname','$parentcategory')";
				if(mysqli_query($conn,$sql)){
					echo "Record created Successfully";
				}
				else{
					die("Failure!!!"+mysqli_error($conn));
				}
			
			break;
			}
		case '6':
			{
				echo "string";
				$productid=$_POST['productid'];
				$quantity=$_POST['quantity'];
				for($i=0;$i<count($productid);$i++){
					$sqlupdate = "UPDATE Stock SET Quantity=Quantity-'".$quantity[$i]."' 
					WHERE Product_ID='".$productid[$i]."' AND Update_Value='1'";
					if (mysqli_query($conn, $sqlupdate)) {
					    echo "true_New record created successfully in purchase"."<br>";
					} 
					else {
					    echo "false_Error: " . $sqlupdate . "<br>" . mysqli_error($conn);
					}
				}
			
			break;
		}

		case '7':
			{
				echo "string";
				$categoryid=$_POST['categoryid'];
				$categoryname=$_POST['categoryname'];
				$parentcategory=$_POST['parentcategory'];
				$sqlupdate = "UPDATE Category SET Category_Name='".$categoryname."', Parent_Category='".$parentcategory."'
				WHERE Category_ID='".$categoryid."'";
				if (mysqli_query($conn, $sqlupdate)) {
				    echo "true_New record created successfully in purchase"."<br>";
				} 
				else {
				    echo "false_Error: " . $sqlupdate . "<br>" . mysqli_error($conn);
				}
			
			break;
		}

		case '8':
			{
				$productsku=$_POST['productsku'];
				$sql = "SELECT GST FROM Product WHERE product_sku=".$productsku;
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
				    $row=mysqli_fetch_assoc($result);
				    $gst=$row['GST'];
				    echo $gst;
				} else {
				    echo "false_Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			break;
		}
	
	default:
		# code...
		break;
	}
}
?>