<?php

	if(! isset($_POST["title"]) ) die("Direct access is not allowed.");

	include_once("classes/project.php");
	$project_obj = new project();
	if( isset($_POST['id']) && !empty($_POST['id']) ){
		$projectid = $project_obj->updateProject($_POST);
	}else{
		$projectid = $project_obj->storeProject($_POST);
	}
	session_start();
	$_SESSION['success'] = ($projectid)?true:false;
	$_SESSION['msg'] = ($_SESSION['success'])?"Project successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"saved"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"save")." project.";
	header('Location: ../'.$_SESSION['user']['fn'].'/projects.php'.(($projectid)?"?projectid=".$projectid:""));
?>