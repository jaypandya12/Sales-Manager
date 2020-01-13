	<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Login to your account</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			<style type="text/css" media="screen">
			#formcontainer{
				text-align: center;
			}
			div.loginform{
				display: inline-block;
				background-color: white;
				width: 400px;
				height: 400px;
				border-color: gray;
				border-radius: 20px;
				border-style: outset;
				transform: translate(0%, 25%);
				color: black;
				font-weight: bold;
				font-family: "Gill Sans", sans-serif;
				text-decoration: none;
				text-align: left;
				/*align-content: center;*/
			}
			form.login{
				padding: 30px;
			}
			input[type=text], select {
			 	width: 100%;
			  	padding: 12px 20px;
			  	margin: 8px 0;
			  	display: inline-block;
			  	border: 1px solid #ccc;
			  	border-radius: 8px;
			  	box-sizing: border-box;
			}
			input[type=password], select {
			 	width: 100%;
			  	padding: 12px 20px;
			  	margin: 8px 0;
			  	display: inline-block;
			  	border: 1px solid #ccc;
			  	border-radius: 8px;
			  	box-sizing: border-box;
			}
			input[type=button], input[type=reset] {
			  	background-color: black;
			  	border: none;
			  	color: white;
			  	padding: 10px 26px;
			  	text-decoration: none;
			  	margin: 4px 2px;
			  	cursor: pointer;
			  	border-radius: 8px;
			}
			#grad1 {
				color: white;
				height: 100%;
				background-color: gray; /* For browsers that do not support gradients */
				background-image: -webkit-linear-gradient(top left, gray, black);
				background-image: -o-linear-gradient(top left, gray, black);
				background-image: linear-gradient(to bottom right, gray, black); /* Standard syntax (must be last) */
				border-radius: 20px;
				border-style: outset;
			}
			body{
				background-image: url("img/background.jpg");
				background-repeat: no-repeat;
			  	background-position: center;
			  	background-size: 110%;
			  	/*background-image-opacity: 0.1;*/
			  	/*filter: alpha(opacity=10);*/
			}
			nav.nav{
				width: 100%;
			}
			ul {
				width: 100%;
			  	list-style-type: none;
			  	margin: 0;
			  	padding: 0;
			  	overflow: hidden;
			  	background-color: #333;
			}

			li {
		  		float: right;
			}

			li a {
		  		display: block;
		  		color: white;
		  		text-align: center;
		  		padding: 14px 16px;
		  		text-decoration: none;
			}

		/* Change the link color to #111 (black) on hover */
			li a:hover {
		  		background-color: #111;
		  		text-decoration: none;
			}
			</style>
			
		</head>
		<body>
			<nav class="nav">
				<ul>
					<li><a href="index.php" title="Contact us">Contact us</a></li>
					<li><a href="signup.html" title="Signup">Signup</a></li>
					<li><a href="index.php" title="About">About</a></li>
					<li><a href="index.php" title="Home">Home</a></li>	
				</ul>
			</nav>
	
			<div class="container" id="formcontainer">
				<div class="loginform">
					<form class="login" id="grad1">
						<legend>Login</legend>
						Username: <input type="text" name="userid" placeholder="Username" id="userid" required><br>
						Password: <input type="password" name="password" placeholder="Password" id="userpassword" minlength="8" required="Password too short"><br>
						<input type="button" name="Submit" value="Submit" onclick="accountAuth()">
						<input type="reset" name="Reset" value="Reset">
						<br>
						<p id="show"></p>
					</form>
					
				</div>
			</div>
		<script type="text/javascript">
				function accountAuth(){
					$.ajax({
						type: "POST",
						url: "loginAuth.php",
						data: { option: "login",
								userid: $('#userid').val(),
							    userpassword: $('#userpassword').val()},
						success: function(html){
							if(html=="Login Success"){
								alert("Login Success");
								window.location.href="index.php";
							}
							else{
								alert(html);
								window.location.href="login.php";
							}
						}
					});
					
				}
			</script>
		</body>
</html>