<?php

	if(! isset($_POST["title"]) ) die("Direct access is not allowed.");
	
	session_start();
	include_once("classes/meeting.php");
	$meeting_obj = new meeting();
	if( isset($_POST['id']) && !empty($_POST['id']) ){
		$meetingid = $meeting_obj->updateMeeting($_POST);
	}else{
		$meetingid = $meeting_obj->storeMeeting($_POST, $_SESSION['user']['id']);
	}
	
	$_SESSION['success'] = ($meetingid)?true:false;
	$_SESSION['msg'] = ($_SESSION['success'])?"Meeting successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"saved"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"save")." meeting.";
	header('Location: ../'.$_SESSION['user']['fn'].'/meetings.php'.(($meetingid)?"?meetingid=".$meetingid:""));
?>