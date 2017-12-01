<?php

	if(! isset($_GET["userid"]) ) die("Direct access is not allowed.");

	include_once("classes/user.php");
	$user_obj = new user();
	if( isset($_GET['userid']) && !empty($_GET['userid']) ){
		$success = $user_obj->deleteUserById($_GET['userid']);
	}
	session_start();
	$_SESSION['success'] = $success;
	$_SESSION['msg'] = ($_SESSION['success'])?"User successfully deleted.":"Error in delete user.";
	header('Location: ../'.$_SESSION['user']['fn'].'/users.php');
?>