<?php
		include 'sqlconfig.php';
		if(isset($_POST['option'])){
		$option=$_POST['option'];
		if($option=="signup"){
		$email=$_POST['signupemail'];
		$userid=$_POST['signupuserid'];
		$userpassword=$_POST['signupuserpassword'];
		$userpassword=password_hash($userpassword, PASSWORD_DEFAULT);
		$sql="INSERT INTO LOGIN(Email, ID, PASSWORD) VALUES('$email','$userid','$userpassword')";
			if(mysqli_query($conn,$sql)){
				echo "Signup Successful";
			}
			else{
				die("Table not created: ".mysqli_error($conn));
			}
		}
		else if($option=="login"){
		$userid=$_POST['userid'];
		$userpassword=$_POST['userpassword'];

		$sql="SELECT * FROM LOGIN WHERE ID='".$userid."'";
		$result=mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result)==1){
			
			while($row=mysqli_fetch_assoc($result)){
				$pwd=$row['Password'];
				
				if(password_verify($userpassword, $pwd)){
					// echo "Inside";
					$flag=1;
					break;
				}
			}
			if(isset($flag)){
				session_start();
				$_SESSION['userid']=$userid;
				echo "Login Success";
			}
			else{
				echo "Login Failed";
			}
		}
		else{
			die("Login Failed".mysqli_error($conn));
		}
	}
}
?>