<?php

	if(! isset($_POST["title"]) ) die("Direct access is not allowed.");
if (empty($_POST['title'])) {
	$_POST['title'] = $_POST['leaderid'];
}
	session_start();
	include_once("classes/team.php");
	$team_obj = new team();
	$_POST['pmid'] = $_SESSION['user']['id'];
	if( isset($_POST['id']) && !empty($_POST['id']) ){
		$teamid = $team_obj->updateTeam($_POST);
	}else{
		$teamid = $team_obj->storeTeam($_POST);
	}
	$_SESSION['success'] = ($teamid)?true:false;
	$_SESSION['msg'] = ($_SESSION['success'])?"Team successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"registered"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"register")." team.";
	header('Location: ../'.$_SESSION['user']['fn'].'/teams.php'.(($teamid)?"?teamid=".$teamid:""));

?>