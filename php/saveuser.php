<?php

if(! isset($_POST["fname"]) ) die("Direct access is not allowed.");


	include_once("classes/user.php");
	$user_obj = new user();
	if( isset($_POST['id']) && !empty($_POST['id']) ){
		$userid = $user_obj->updateUser($_POST);
	}else{
		$userid = $user_obj->storeUser($_POST);
	}
	session_start();
	$_SESSION['success'] = ($userid)?true:false;
	$_SESSION['msg'] = ($_SESSION['success'])?"User successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"registered"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"register")." user.";
	header('Location: ../'.$_SESSION['user']['fn'].'/users.php'.(($userid)?"?userid=".$userid:""));
?>