<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Meeting</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
</head>
<body>
<div id="wraper">
     <?php include("header.php"); 
function test_input($data) {
  $data = trim($data);
  $data = mysql_real_escape_string($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
}
	if (isset($_POST['submit'])) {
		$title			= test_input($_POST['title']);
		$meeting_date	= $_POST['meetingdate'];
		$description	= test_input($_POST['description']);
		if (empty($title)) {
			$errors['title'] = 'Enter a title.';
		} else {
			$title = preg_split('/[\s]+/', $title);
			$title = implode(" ",$title);
		}
		if (empty($description)) {
			$errors['description'] = 'Enter a description.';
		} else {
			$description = preg_split('/[\s]+/', $description);
			$description = implode(" ",$description); 
		}
		if (empty($meeting_date)) {
			$errors['meeting_date'] = 'Select a Meeting Date.';
		}
		if (empty($errors)) {
			session_start();
			include_once("../php/classes/meeting.php");
			$meeting_obj = new meeting();
			if( isset($_POST['id']) && !empty($_POST['id']) ){
				$meetingid = $meeting_obj->updateMeeting($_POST);
			}else{
				$meetingid = $meeting_obj->storeMeeting($_POST, $_SESSION['user']['id']);
			}
			
			$_SESSION['success'] = ($meetingid)?true:false;
			$_SESSION['msg'] = ($_SESSION['success'])?"Meeting successfully ".(( isset($_POST['id']) && !empty($_POST['id']) )?"updated":"saved"):"Error in ".(( isset($_POST['id']) && !empty($_POST['id']) )?"update":"save")." meeting.";
			header('Location: ../'.$_SESSION['user']['fn'].'/meetings.php'.(($meetingid)?"?meetingid=".$meetingid:""));
		}
	}
	 
	 ?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<span id="form_heading">Meeting Form</span>
		<?php
		$team = false;
		if( isset($_GET['teamid']) ){
			include("../php/classes/team.php");
			$team_obj = new team();
			$teaminfo = $team_obj->getTeamById( $_GET['teamid'] );
			$team = mysql_fetch_assoc( $teaminfo['team'] );
			$members_arr = Array();
			while($member = mysql_fetch_assoc( $teaminfo['members'] )){ $members_arr[ $member['id'] ] = Array('userid' => $member['userid'], 'roleid' => $member['roleid']); }
		}
		?><br /><br />
<form action="" method="post" id="newteam">
<table style="margin:0 auto">

  <tr>
    <td>Subject</td>
    <td style="border-right:none"><input style="width:472px;" type="text" name="title" class="required-field " value="<?php echo ((isset($title))?$title:""); ?>"/><?php if(isset($errors['title'])) echo '<li>'.$errors['title'] . '</li>'?></td>
  </tr>
  <tr>
    <td>Meeting Date</td>
    <td style="border-right:none"><input type="text" name="meetingdate" id="meetingdate" value="<?php echo ((isset($meeting_date))?explode(' ',$meeting_date)[0]:""); ?>"/><?php if(isset($errors['meeting_date'])) echo '<li>'.$errors['meeting_date'] . '</li>'?></td>
  </tr>
  <tr>
    <td>Details</td>
    <td style="border-right:none"><textarea name="description" placeholder=" Details " rows="10" cols="56"><?php echo ((isset($user))?$user['address']:""); ?></textarea><?php if(isset($errors['description'])) echo '<li>'.$errors['description'] . '</li>'?></td>
  </tr>
  <tr>
  	<td></td>
  	<td style="border-right:none"><input type="submit" name="submit" id="submit" value="Send" />
						<input type="reset" value="Reset" />
				<input type="hidden" name="id" value="<?php echo ((isset($team))?$team['id']:""); ?>" /></td>
  </tr>
</table>
			</form>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newteam.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#meetingdate').datepicker({
		dateFormat: 'yy-mm-dd',
		minDate:0
	}).keyup(function() {
		$(this).val('');
	});
	
});
</script>

     <?php include("footer.php"); ?>
</div>
</div>
</body>
</html>
