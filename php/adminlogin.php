<?php

	if(! isset($_POST["username"]) ) die("Direct access is not allowed.");

	include_once("classes/user.php");
	$user_obj = new user();
	
	if( $user = $user_obj->getUserByUsername($_POST["username"]) ){
		$result = array();
		if(md5($_POST["password"]) == $user['password'] ){
			$result['success'] = true;
			$result['msg'] = "User successfully login. Redirecting ...";
			$result['user'] = $user;
			session_start();
			$_SESSION['user'] = $user;
		}else{
			$result['success'] = false;
			$result['msg'] = "Invalid username or password";
		}
	}else{
		$result['success'] = false;
		$result['msg'] = "Username not register yet";
	}
	echo json_encode($result);exit;
?>