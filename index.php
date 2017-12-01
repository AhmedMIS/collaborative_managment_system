<?php session_start(); 
	if( isset( $_SESSION['user'] ) ){
		header('Location: '.$_SESSION['user']['fn']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<script type="text/javascript" src="include/js/jquery-2.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="include/css/global.css" />
<link rel="stylesheet" type="text/css" href="include/css/login.css" />
<script type="text/javascript" src="login.js"></script>
</head>

<body>
<div id="wraper">
	<div id="top">
		<div class="header_wrapper">
			<div id="logo"><a href="#"><img src="include/images/pm.png" border="0"></a></div>
			<div id="heading" > <h2 style="color:#FFF;">Collaborative Project Management Suite</h2></div>
		</div>
	</div>
	<div id="heading1"><h3>User Login</h3></div>
	<div id="bottom" style="border-radius:100px;20px solid"/>
	<div id="login-pic">
		<img src="include/images/Login.png"/>
		<div id="login-form">
			<form method="post" name="Form" id="form-properties" >
			<div id="field1">
				<div id="msgbar" ></div>
				<label for="user-name">Username</label>
				<input type="text" name="username" id="username" /><div id="error_username" class="color"> </div>
			</div>
			<div id="field2">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" /><div id="error_password" class="color"></div>
			</div>
			<div id="login-button">
				<input type="submit" value="Login" id="login-btn" style="width:60px" />
				<input type="reset" value="Reset" style="width:60px" />
			</div>
			</form>
		</div>

	 </div>
</div>
<div id="Bottom-Border"></div>
<div id="footer"><font color="#3366FF"><b>©Copyright: 2014. Powered By Brainiacs Tech Lahore.(brainiacs_tech@live.com)</b></font></div>
</body>
</html>
