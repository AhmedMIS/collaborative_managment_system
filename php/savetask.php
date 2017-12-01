<?php

	if(! isset($_POST["title"]) ) die("Direct access is not allowed.");

	session_start();
	include_once("classes/task.php");
	$task_obj = new task();
	$_POST['pmid'] = $_SESSION['user']['id'];
	if( isset($_POST['id']) && !empty($_POST['id']) ){
		$taskid = $task_obj->updateTask($_POST);
		
	}else{
		$taskid = $task_obj->storeTask($_POST);
		
	}
	$_SESSION['success'] = ($taskid)?true:false;
	$_SESSION['msg'] = ($_SESSION['success'])?"Task successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"saved"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"save")." task.";
	header('Location: ../'.$_SESSION['user']['fn'].'/tasks.php'.(($taskid)?"?taskid=".$taskid:""));
?>