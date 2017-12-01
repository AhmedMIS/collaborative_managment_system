<?php

	if(! isset($_POST["id"]) ) die("Direct access is not allowed.");

	session_start();
	include_once("classes/task.php");
	$task_obj = new task();
	$_POST['userid'] = $_SESSION['user']['id'];
	$_POST['usertype_id'] = $_SESSION['user']['usertype_id'];
	$success = $task_obj->submitTask($_POST);
	
	//echo $_POST['pmid'];

	$_SESSION['success'] = $success;
	$_SESSION['msg'] = ($_SESSION['success'])?"Task successfully submited.":"Error in submit task.";
	header('Location: ../'.$_SESSION['user']['fn'].'/tasks.php');
	
?>