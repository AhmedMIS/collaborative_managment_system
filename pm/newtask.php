<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN(Assistant)</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
<link rel="stylesheet" type="text/css" href="../include/css/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css" />

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
		 $project_id	= $_POST['projectid'];
		 $title			= test_input($_POST['title']);
		 $team_id		= $_POST['teamid'];
		 $starting_date	= $_POST['startingdate'];
		 $description	= test_input($_POST['description']);
		 if (empty($title)) {
			 $errors['title'] = 'Enter a title';
		 } else {
			$title = preg_split('/[\s]+/', $title);
			$title = implode(" ",$title);
		 }
		 if (empty($team_id)) {
			 $errors['team_id'] = 'Select a Team';
		 }
		 if (empty($_POST['assigneeid'])) {
			 $errors['assignee_id'] = 'Select Team leader';
		 } else {
			 $assignee_id	= $_POST['assigneeid']; 
		 }
		 if (empty($starting_date)) {
			 $errors['starting_date'] = 'Select a Date.';
		 }
		 if (empty($description)) {
			 $errors['description'] = 'Enter a Description';
		 } else {
			$description = preg_split('/[\s]+/', $description);
			$description = implode(" ",$description);
		 }
		 if (empty($errors)) {
			include_once("../php/classes/task.php");
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
 
		 }
	 }
	 
	 ?>
	 <script type="text/javascript">jQuery(document).ready(function(){ jQuery("div#cssmenu ul li").removeClass("active"); jQuery("li#new-menu-btn").addClass("active"); });</script>
     <div id="body">
	 <div class="cb"></div>
		<span id="form_heading">Task Form</span>
		<?php
		/*
		include("../php/classes/task.php");
		$task_obj = new task();
		$task_obj->makeDir("nomi");
		$task_obj->makeDir("nomi");
		*/
		$task = false;
		if( isset($_GET['taskid']) ){
			include("../php/classes/task.php");
			$task_obj = new task();
			$taskinfo = $task_obj->getTaskById( $_GET['taskid'] );
			$task = @mysql_fetch_assoc( $taskinfo['task'] );
			$members_arr = Array();
			while($member = @mysql_fetch_assoc( $taskinfo['members'] )){ 
				$members_arr[ $member['id'] ] = Array('userid' => $member['userid'], 'roleid' => $member['roleid']); 
			}
		}
			
		?><br /><br />
<form action="" method="post" id="newtask">
<table style="margin:0 auto">
  <tr>
    <td>Project</td>
    <td style="border-right:none"><select name="projectid" class="chosen-select-full-width" >
							<?php 
								include_once("../php/classes/project.php");
								$project_obj = new project();
								$data['userid'] = $_SESSION['user']['id'];
								$projects = $project_obj->getProjectsBySearch($data);
								if($projects){
									while( $project = mysql_fetch_assoc($projects) ){
										echo '<option value="'.$project['id'].'" >'.$project['title'].'</option>';
									}
								}
							?>
						</select></td>
  </tr>
  <tr>
    <td>Task&nbsp;Title</td>
    <td style="border-right:none"><input  type="text" name="title" class="required-field " value="<?php echo ((isset($title))?$title:""); ?>" /><?php if(isset($errors['title'])) echo '<li>'.$errors['title'] . '</li>'?></td>
  </tr>
  <tr>
    <td>Team</td>
    <td style="border-right:none"><select name="teamid" id="teamid" class="chosen-select" style="width:40%" ><option value="0">Select Team<option>
							<?php
								include_once("../php/classes/team.php");
								$team_obj = new team();
								$data['userid'] = $_SESSION['user']['id'];
								$teams = $team_obj->getTeamsBySearch($data);
								if($teams){
									while( $team = mysql_fetch_assoc($teams) ){
										echo '<option value="'.$team['id'].'" '.(( $task && isset($task['leaderid']) && $task['leaderid'] == $team['id'] )?"selected":"").'>'.$team['title'].'</option>';
									}
								}
							?>
						</select><?php if(isset($errors['team_id'])) echo '<li>'.$errors['team_id'] . '</li>'?></td>
  </tr>
  <tr>
    <td>Assign To</td>
    <td style="border-right:none"><select name="assigneeid" id="assigneeid" class="chosen-select" style="width:40%"></select>
		<?php if(isset($errors['assignee_id'])) echo '<li>'.$errors['assignee_id'] . '</li>'?></td>
  </tr>
  <tr>
    <td>Starting Date</td>
    <td style="border-right:none"><input type="text" name="startingdate" id="startingdate" />
    <?php if(isset($errors['starting_date'])) echo '<li>'.$errors['starting_date'] . '</li>'?></td>
  </tr>
  <tr>
    <td></td>
    <td style="border-right:none"><textarea name="description" placeholder=" Details " rows="10" cols="56"><?php echo ((isset($description))?$description:""); ?></textarea>
    <?php if(isset($errors['description'])) echo '<li>'.$errors['description'] . '</li>'?></td>
  </tr>
</table><br /><br />
<input type="submit" name="submit" id="submit" value="Save" style="margin-left:300px" />
<input type="reset" value="Reset" />
<input type="hidden" name="id" value="<?php echo ((isset($task))?$task['id']:""); ?>" />
</form>
	 <script type="text/javascript" src="../include/js/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/newtask.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#startingdate').datepicker({
		dateFormat: 'yy-mm-dd',
		minDate:0
	}).keyup(function() {
		$(this).val('');
	});
	
});
</script>

     <?php include("footer.php"); ?>
</div>
</body>
</html>
