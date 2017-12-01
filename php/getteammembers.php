<?php
	if(! isset($_POST["teamid"]) ) die("Direct access is not allowed.");

	include_once("classes/team.php");
	$team_obj = new team();
	$members = $team_obj->getMembersByTeamId($_POST['teamid']);
	$memberoptions = "";
	while( $member = mysql_fetch_assoc($members) ){
		$memberoptions .= '<option value="'.$member['id'].'" >'.$member['fname'].' '.$member['lname'].'</option>';
	}
	echo $memberoptions; exit;
?>